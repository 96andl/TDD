<?php
    /**
     * Created by PhpStorm.
     * User: andr
     * Date: 07.10.17
     * Time: 20:27
     */

    namespace App\Filters;


    use Illuminate\Http\Request;

    /**
     * Class Filters
     * @package App\Filters
     */
    abstract class Filters
    {
        /**
         * @var Request
         */
        protected $request;
        /**
         * @var
         */
        protected $builder;

        /**
         * @var array
         */
        protected $filters = [];

        /**
         * ThreadFilters constructor.
         */
        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        /**
         * @param $builder
         * @return mixed
         */
        public function apply($builder)
        {
            $this->builder = $builder;

            $this->getFilters()
                ->filter(function ($value, $filter){
                    return method_exists($this,$filter);
                })
                ->each(function($value, $filter) {
                   $this->$filter($value);
                });

            return $this->builder;
        }


        /**
         * @return array
         */
        private function getFilters()
        {
            return collect(array_filter($this->request->only($this->filters)));
        }
    }