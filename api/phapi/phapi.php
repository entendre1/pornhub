<?php

namespace Noxyra\PornhubApi\Api;

include "phapi_params.php";

use Noxyra\PornhubApi\Parameters\PornhubApiParameters;

class PornhubApi
{
    const ENDPOINT = "http://www.pornhub.com/webmasters/";

    public function searchVideos(
        string $catagory = PornhubApiParameters::_PARAM_CATEGORY_DEFAULT,
        int $page = PornhubApiParameters::_PARAM_PAGE_DEFAULT,
        string $search = PornhubApiParameters::_PARAM_SEARCH_DEFAULT,
        string $ordering = PornhubApiParameters::_PARAM_ORDERING_DEFAULT,
        string $period = PornhubApiParameters::_PARAM_PERIOD_DEFAULT,
        string $thumbsize = PornhubApiParameters::_PARAM_THUMBSIZE_DEFAULT,
        array $stars = PornhubApiParameters::_PARAM_STARS_DEFAULT,
        array $tags = PornhubApiParameters::_PARAM_TAGS_DEFAULT
    )
    {
        return $this->getResults('search', [
            'category' => urlencode($catagory),
            'page' => urlencode($page),
            'search' => urlencode($search),
            'ordering' => urlencode($ordering),
            'period' => urlencode($period),
            'thumbsize' => urlencode($thumbsize),
            'stars' => $stars,
            'tags' => $tags
        ]);
    }

    public function getVideoById(string $originalId, string $thumbsize = PornhubApiParameters::_PARAM_THUMBSIZE_DEFAULT)
    {
        return $this->getResults('video_by_id', [
            'id' => $originalId,
            'thumbsize' => $thumbsize
        ]);
    }

    public function getVideoEmbedCode(string $originalId)
    {
        return $this->getResults('video_embed_code', [
            'id' => $originalId
        ]);
    }

    public function getDeletedVideos(int $page)
    {
        return $this->getResults('deleted_videos', [
            'page' => $page,
        ]);
    }

    public function isVideoActive(string $originalId)
    {
        return $this->getResults('is_video_active', [
            'id' => $originalId,
        ]);
    }

    public function getCategoriesList()
    {
        return $this->getResults('categories');
    }

    public function getTagsList(string $firstChar = '0')
    {
        return $this->getResults('tags', [
            'list' => $firstChar
        ]);
    }

    public function getStarList()
    {
        return $this->getResults('stars');
    }

    public function getStarDetailedList()
    {
        return $this->getResults('stars_detailed');
    }

    // -- PRIVATE --

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     */
    private function getResults($method = '', $params = [])
    {
        return json_decode(file_get_contents(self::ENDPOINT . $method . $this->buildGetParams($params)));
    }

    /**
     * @param array $params
     * @return string
     */
    private function buildGetParams(array $params) {
        $i = 0;
        $s = '';
        foreach ($params as $key => $value) {
            $s .= ($i === 0) ? '?' : '&';
            $s .= $key . '=';
            $s .= (is_array($value)) ? implode(',', $value) : $value;
            $i++;
        }

        return (string) $s;
    }
}