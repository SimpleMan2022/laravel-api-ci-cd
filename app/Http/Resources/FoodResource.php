<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function __construct($resource, private string $context)
  {
    parent::__construct($resource);
    $this->context = $context;
  }

  public function toArray(Request $request): array
  {
    if ($this->context === 'create') {
      return [
        'name' => $this->name,
        'description' => $this->description,
        'price' => $this->price,
      ];
    } else if ($this->context === 'findbyid') {
      return [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'price' => $this->price,
      ];
    }
  }
}
