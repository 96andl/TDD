<?php

    namespace App\ThreadFilters;

    use App\User;
    use Illuminate\Http\Request;
    use App\Filters\Filters;

    /**
     * Class ThreadFilters
     * @package App
     */
    class ThreadFilters extends Filters
    {

        protected $filters = ['by'];
        /**
         * @param $builder
         * @return mixed
         */
        protected function by()
        {
            $user = User::where('name', $this->request->by)->firstOrFail();
            if (!empty($user->id)) {
                return $this->builder->where('user_id', $user->id);
            }


        }

    }