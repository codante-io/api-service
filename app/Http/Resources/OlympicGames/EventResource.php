<?php

namespace App\Http\Resources\OlympicGames;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // dd($this->discipline);
        // if (! $this->discipline) {
        //     dd($this);
        // }

        return [
            'id' => $this->id,
            'day' => $this->day,
            'discipline_name' => $this->discipline_name,
            'discipline_pictogram' => $this->discipline->pictogram_url,
            'name' => $this->name,
            'venue_name' => $this->venue_name,
            'event_name' => $this->event_name,
            'detailed_event_name' => $this->event_unit_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'is_medal_event' => $this->is_medal_event,
            'is_live' => $this->is_live,
            'competitors' => $this->competitors->map(function ($competitor) {
                return [
                    'country_id' => $competitor->country->name ?? '',
                    'country_flag_url' => $competitor->country->flag_url ?? '',
                    'competitor_name' => $competitor->name,
                    'position' => $competitor->position,
                    'result_position' => $competitor->result_position,
                    'result_winnerLoserTie' => $competitor->result_winnerLoserTie,
                    'result_mark' => $competitor->result_mark,
                ];
            }),
            // 'discipline' => new DisciplineResource($this->discipline),
            // 'venue' => new VenueResource($this->venue),
            // 'competitors' => CompetitorResource::collection($this->competitors),
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
