<?php

namespace Noxyra\PornhubApi\Parameters;

class PornhubApiParameters
{
    const _PARAM_ORDERING_NEWEST = 'newest';
    const _PARAM_ORDERING_MOSTVIEWED = 'mostviewed';
    const _PARAM_ORDERING_RATING = 'rating';

    const _PARAM_PERIOD_WEEKLY = 'weekly';
    const _PARAM_PERIOD_MONTHLY = 'monthly';
    const _PARAM_PERIOD_ALLTIME = 'alltime';

    const _PARAM_THUMBSIZE_SMALL = 'small';
    const _PARAM_THUMBSIZE_MEDIUM = 'medium';
    const _PARAM_THUMBSIZE_LARGE = 'large';
    const _PARAM_THUMBSIZE_SMALLHD = 'small_hd';
    const _PARAM_THUMBSIZE_MEDIUMHD = 'medium_hd';
    const _PARAM_THUMBSIZE_LARGEHD = 'large_hd';

    const _PARAM_PAGE_DEFAULT = 1;
    const _PARAM_STARS_DEFAULT = [];
    const _PARAM_TAGS_DEFAULT = [];
    const _PARAM_CATEGORY_DEFAULT = '';
    const _PARAM_SEARCH_DEFAULT = '';

    const _PARAM_ORDERING_DEFAULT = self::_PARAM_ORDERING_MOSTVIEWED;
    const _PARAM_PERIOD_DEFAULT = self::_PARAM_PERIOD_WEEKLY;
    const _PARAM_THUMBSIZE_DEFAULT = self::_PARAM_THUMBSIZE_LARGEHD;

    public static function getOrderingParams()
    {
        return [
            self::_PARAM_ORDERING_NEWEST,
            self::_PARAM_ORDERING_MOSTVIEWED,
            self::_PARAM_ORDERING_RATING,
        ];
    }

    public static function getPeriodParams()
    {
        return [
            self::_PARAM_PERIOD_WEEKLY,
            self::_PARAM_PERIOD_MONTHLY,
            self::_PARAM_PERIOD_ALLTIME,
        ];
    }

    public static function getThumbsizeParams()
    {
        return [
            self::_PARAM_THUMBSIZE_SMALL,
            self::_PARAM_THUMBSIZE_MEDIUM,
            self::_PARAM_THUMBSIZE_LARGE,
            self::_PARAM_THUMBSIZE_SMALLHD,
            self::_PARAM_THUMBSIZE_MEDIUMHD,
            self::_PARAM_THUMBSIZE_LARGEHD,
        ];
    }

}