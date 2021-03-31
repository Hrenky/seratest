<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\Crew;
use App\Models\Genres;
use App\Models\Languages;
use App\Models\ShowCountries;
use App\Models\ShowCrew;
use App\Models\ShowGenre;
use App\Models\ShowLanguage;
use App\Models\Shows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ShowController
{
    protected $APIkey = '27223bf9';

    public function showsByName() {

    }

    public function showsByDate() {

    }

    public function getShowLocal(Request $request) {
        $showID = $request->get('showID');

        $show = Shows::findOrFail($showID);

        if(!$show){
            return view('single-show', ['noShow' => true]);
        }

        $showData = $show->toArray();

        $showData['ratings'] = json_decode($showData['ratings']);

        $showData['genres'] = DB::table('show_genre', 'sg')
            ->join('genres as g', 'sg.genreID', '=', 'g.genreID')
            ->select('g.genre')
            ->where('sg.showID', '=', $show->showID)
            ->get()->toArray();

        $showData['languages'] =  DB::table('show_language', 'sl')
            ->join('languages as l', 'sl.langID', '=', 'l.langID')
            ->select('l.language')
            ->where('sl.showID', '=', $show->showID)
            ->get()->toArray();

        $showData['countries'] = DB::table('show_countries', 'sc')
            ->join('countries as c', 'c.countryID', '=', 'sc.countryID')
            ->select('c.country')
            ->where('sc.showID', '=', $show->showID)
            ->get()->toArray();

        $showData['crew'] = ['directors' => [], 'writers' => [], 'actors' => []];
        $crew = DB::table('show_crew', 'sc')
            ->join('crew as c', 'c.crewID', '=', 'sc.crewID')
            ->select(['c.name', 'c.type'])
            ->where('sc.showID', '=', $show->showID)
            ->get()->toArray();

        foreach($crew as $c){
            switch ((int) $c->type){
                case Crew::DIRECTOR:
                    $showData['crew']['directors'][] = $c->name;
                    break;
                case Crew::WRITER:
                    $showData['crew']['writers'][] = $c->name;
                    break;
                case Crew::ACTOR:
                    $showData['crew']['actors'][] = $c->name;
                    break;
            }
        }

        return view('single-show', ['show' => $showData]);
    }

    public function getAllShowLocal(Request $request) {
        $title = $request->get('title');
        $type = $request->get('type');

        $showData = [];

        $shows = Shows::where('title', 'LIKE', '%'.$title.'%')
                        ->where('type', $type)
                        ->get();

        if($shows->count() === 0){
            return view('local-shows', ['noShow' => true]);
        }

        foreach ($shows as $show){
            $showData[] = $show->toArray();
        }

        return view('local-shows', ['shows' => $showData]);
    }

    public function getShowOnline(Request $request) {
        $title = urlencode($request->get('title'));
        $type = $request->get('type');

        $shows = [];
        $show = Http::get('http://www.omdbapi.com/?apikey='.$this->APIkey.'&t='.$title.'&type='.$type)->json();

        if($show["Response"] === "False"){
            $response = false;
            $view = view('local-shows', ['noShow' => true, 'failResponse' => $show["Error"]])->render();
        } else {
            $this->saveMovie($show['imdbID'], $shows);
            $response = true;
            $view = view('single-show', ['show' => $shows])->render();
        }

        /*foreach($showList as $show){
            $this->saveMovie($show['imdbID'], $shows);
        }*/

        return json_encode(['response'=>$response, 'view' => $view]);
    }

    public function saveMovie($imdbID, &$shows) {
        $newShow = json_decode(Http::get('http://www.omdbapi.com/?apikey='.$this->APIkey.'&i='.$imdbID.'&plot=full'));

        $filename = '';
        if($newShow->Poster !== "N/A"){
            $filename = str_replace(' ', '-', strtolower($newShow->Title)).'.jpg';
            Storage::disk('posters')->put($filename, file_get_contents($newShow->Poster));
        }

        $show = Shows::firstOrCreate([
            'title' => $newShow->Title,
            'year' => $newShow->Year,
            'rated' => $newShow->Rated,
            'release' => date('Y-m-d', strtotime($newShow->Released)),
            'length' => preg_replace('/\s.+?$/', '', $newShow->Runtime),
            'plot' => $newShow->Plot,
            'poster' => $filename,
            'ratings' => json_encode($newShow->Ratings),
            'type' => $newShow->Type
        ]);

        $shows = $show->toArray();
        $shows['ratings'] = json_decode($shows['ratings']);

        $shows['genres'] = [];
        $genres = explode(',', $newShow->Genre);
        foreach($genres as $genre){
            $g = Genres::firstOrCreate(['genre' => trim($genre)]);

            $tempObject = new \stdClass();
            $tempObject->genre = $g->genre;

            $shows['genres'][] = $tempObject;

            ShowGenre::firstOrCreate([
                'showID' => $show->showID,
                'genreID' => $g->genreID
            ]);
        }

        $shows['languages'] = [];
        $languages = explode(',', $newShow->Language);
        foreach($languages as $lang){
            $l = Languages::firstOrCreate(['language' => trim($lang)]);

            $tempObject = new \stdClass();
            $tempObject->language = $l->language;

            $shows['languages'][] = $tempObject;

            ShowLanguage::firstOrCreate([
                'showID' => $show->showID,
                'langID' => $l->langID
            ]);
        }

        $shows['countries'] = [];
        $countries = explode(',', $newShow->Country);
        foreach($countries as $country){
            $c = Countries::firstOrCreate(['country' => trim($country)]);

            $tempObject = new \stdClass();
            $tempObject->country = $c->country;

            $shows['countries'][] = $tempObject;

            ShowCountries::firstOrCreate([
                'showID' => $show->showID,
                'countryID' => $c->countryID
            ]);
        }

        $shows['crew'] = ['director' => [], 'writer' => [], 'actor' => []];
        $directors = explode(',', $newShow->Director);
        foreach($directors as $director){
            $name = trim(preg_replace('/\(\w+\)$/', '', $director));
            $cd = Crew::firstOrCreate(['name' => $name, 'type' => Crew::DIRECTOR]);

            $shows['crew']['directors'][] = $cd->name;

            ShowCrew::firstOrCreate([
                'showID' => $show->showID,
                'crewID' => $cd->crewID
            ]);
        }

        $writers = explode(',', $newShow->Writer);
        foreach($writers as $writer){
            $name = trim(preg_replace('/\(\w+\)$/', '', $writer));
            $cw = Crew::firstOrCreate(['name' => $name, 'type' => Crew::WRITER]);
            $shows['crew']['writers'][] = $cw->name;

            ShowCrew::firstOrCreate([
                'showID' => $show->showID,
                'crewID' => $cw->crewID
            ]);
        }

        $actors = explode(',', $newShow->Actors);
        foreach($actors as $actor){
            $name = trim(preg_replace('/\(\w+\)$/', '', $actor));
            $ca = Crew::firstOrCreate(['name' => $name, 'type' => Crew::ACTOR]);
            $shows['crew']['actors'][] = $ca->name;

            ShowCrew::firstOrCreate([
                'showID' => $show->showID,
                'crewID' => $ca->crewID
            ]);
        }
    }
}
