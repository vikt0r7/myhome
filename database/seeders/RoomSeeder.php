<?php

namespace Database\Seeders;

use Botble\Hotel\Models\Booking;
use Botble\Hotel\Models\BookingAddress;
use Botble\Hotel\Models\BookingRoom;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\RoomCategory;
use Botble\Slug\Models\Slug;
use Botble\Base\Supports\BaseSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use SlugHelper;

class RoomSeeder extends BaseSeeder
{
    public function run()
    {
//        $this->uploadFiles('rooms');

        Room::truncate();

        $rooms = [
            [
                'name'             => 'Double apartment DeLuxe',
                'description'      => 'Double apartments deluxe are newly renovated in summer 2020, size 55 sqm comprising of an entrance hall with a large wardrobe, dining area with kitchen unit, living area with sofa, bed and bathroom with a shower. Kitchen is equipped with microwave, oven, fridge with freezer, hob, dishwasher, washing machine, kettle, kitchen utensils. Cleaning is provided once a week. Apartment has air-condition. Monthly rent is excluded of energies and water consumption.',
                'room_category_id' => RoomCategory::where('name', 'Luxury')->first()->value('id'),
                'images'           => json_encode(['rooms/1/01.jpg', 'rooms/1/02.jpg']),
                'price'            => 1000,
                'number_of_rooms'  => 15,
                'number_of_beds'   => 1,
                'max_adults'       => 2,
                'max_children'     => 1,
                'size'             => 200,
                'tax_id'           => 1,
                'is_featured'      => 1,
            ],
            [
                'name'             => 'Single Apartment Deluxe',
                'description'      => 'Studio apartments newly renovated in summer 2020, size 25 sqm comprising of an entrance hall with a large wardrobe, dining area with kitchen unit, living area, bed and bathroom with a shower. kitchen is equipped with microwave, oven, fridge with freezer, hob, dishwasher, washing machine, kettle, kitchen utensils. Cleaning is provided once a week. Apartment has air-condition. Monthly rent is excluded of energies and water consumption.',
                'room_category_id' => RoomCategory::where('name', 'Luxury')->first()->value('id'),
                'images'           => json_encode(['rooms/2/01.jpg', 'rooms/2/02.jpg', 'rooms/2/03.jpg']),
                'price'            => 650,
                'number_of_rooms'  => 15,
                'number_of_beds'   => 1,
                'max_adults'       => 1,
                'max_children'     => 0,
                'size'             => 200,
                'tax_id'           => 1,
                'is_featured'      => 1,
            ],
            [
                'name'             => 'Double Apartment',
                'description'      => 'Double apartment of the size of 55 sqm is fully furnished with an equipped kitchen. Kitchen is equipped with table and chairs with appliances and basic kitchen tools. Living space offers 2 comfortable sofas, coffee table, TV and comfortable single bed. Separate bedroom is equipped with double bed or twin beds, large wardrobe. Double apartment offers spacious closet area. Bathroom is equipped with shower, basin, mirror and toilet with some shelf space. Bed linens and towels are provided at the arrival and changed weekly. All windows have blinds, no balcony.',
                'room_category_id' => RoomCategory::where('name', 'Double Bed')->first()->value('id'),
                'images'           => json_encode(['rooms/3/01.jpg', 'rooms/3/02.jpg','rooms/3/03.jpg']),
                'price'            => 62,
                'number_of_rooms'  => 15,
                'number_of_beds'   => 1,
                'max_adults'       => 1,
                'max_children'     => 0,
                'size'             => 200,
                'tax_id'           => 1,
                'is_featured'      => 1,
            ],
            [
                'name'             => 'Single apartment',
                'description'      => 'Single apartment of the size of 25 sqm is fully furnished with an equipped kitchen. Kitchen is equipped with table and 2 chairs with appliances and basic kitchen tools. Living space offers comfortable sofa, coffee table, TV and comfortable single bed. Bathroom is equipped with shower, basin, mirror and toilet with some shelf space. Bed linens and towels are provided at the arrival and changed weekly. All windows have blinds, no balcony.',
                'room_category_id' => RoomCategory::where('name', 'Relax')->first()->value('id'),
                'images'           => json_encode(['rooms/4/01.jpg', 'rooms/4/02.jpg','rooms/4/03.jpg']),
                'price'            => 39,
                'number_of_rooms'  => 15,
                'number_of_beds'   => 1,
                'max_adults'       => 1,
                'max_children'     => 0,
                'size'             => 200,
                'tax_id'           => 1,
                'is_featured'      => 1,
            ],
            [
                'name'             => 'Single Apartment Premium',
                'description'      => 'Single premium apartment of the size of 25 sqm is  renovated offering clients higher standard than normal standard apartments. The apartment is furnished with an equipped kitchen. Kitchen is equipped with table and 2 chairs with appliances and basic kitchen tools. Living space offers comfortable sofa, coffee table, flat TV, soft carpet and spacious single bed. Premium apartment offers spacious closet. Bathroom is equipped with shower, basin, mirror and toilet with some shelf space. Bed linens and towels are provided at the arrival and changed weekly. All windows have blinds and curtains, no balcony.',
                'room_category_id' => RoomCategory::where('name', 'Double Bed')->first()->value('id'),
                'images'           => json_encode(['rooms/5/01.jpg', 'rooms/5/02.jpg','rooms/5/03.jpg']),
                'price'            => 47,
                'number_of_rooms'  => 15,
                'number_of_beds'   => 1,
                'max_adults'       => 1,
                'max_children'     => 0,
                'size'             => 200,
                'tax_id'           => 1,
                'is_featured'      => 1,
            ],
        ];

        Slug::where(['reference_type' => Room::class])->delete();
        Booking::truncate();
        BookingAddress::truncate();
        BookingRoom::truncate();

        foreach ($rooms as $room) {
            $room = Room::create($room);

            $room->amenities()->sync([1, 2, 3, 4, 6, 7, 9, 11]);

            Slug::create([
                'reference_type' => Room::class,
                'reference_id'   => $room->id,
                'key'            => Str::slug($room->name),
                'prefix'         => SlugHelper::getPrefix(Room::class),
            ]);
        }

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            Artisan::call('cms:language:sync', ['class' => Room::class]);
        }
    }
}
