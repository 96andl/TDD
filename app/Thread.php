<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /**
     * App\Thread
     *
     * @property int $id
     * @property int $user_id
     * @property string $title
     * @property string $body
     * @property \Carbon\Carbon|null $created_at
     * @property \Carbon\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereBody($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereUserId($value)
     * @mixin \Eloquent
     */
    class Thread extends Model
    {
        /**
         * @var array
         */
        protected $appends = [
            'path', 'creator_name'
        ];

        /**
         * @var array
         */
        protected $guarded = [];

        /**
         * @return string
         */
        public function getPathAttribute()
        {
            return '/threads/' .$this->channel->slug .'/'. $this->id;
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function replies()
        {

            return $this->hasMany(Reply::class);

        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function creator()
        {

            return $this->belongsTo(User::class, 'user_id');

        }

        /**
         * @return mixed
         */
        public function getCreatorNameAttribute()
        {
            return $this->creator->name;
        }

        /**
         * @param $reply
         */
        public function addReply($reply)
        {
            $this->replies()->create($reply);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function channel() {
            return $this->belongsTo(Channel::class);
        }

        public function scopeFilter($query,$filter) {
            return $filter->apply($query);
        }
    }
