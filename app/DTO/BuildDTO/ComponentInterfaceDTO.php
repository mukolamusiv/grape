<?php


namespace App\DTO\BuildDTO;


use App\Models\Lessons;
use Illuminate\Support\Collection;

interface ComponentInterfaceDTO
{

    /**
     * @return array
     */
    public function object():array;

    /**
     * @return mixed
     */
    public function find();

    /**
     * ComponentInterfaceDTO constructor.
     * @param Collection $lesson
     * @param int $user_id
     */
    public function __construct(Collection $lesson ,int $user_id);

    /**
     * @param $request
     * @return bool
     */
    public function setAnswer($request):bool;

    /**
     * @return bool
     */
    public function getCompleted():bool;
}
