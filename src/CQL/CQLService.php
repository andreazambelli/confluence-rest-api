<?php namespace Lesstif\Confluence\CQL;

use Lesstif\Confluence\ConfluenceClient;

class CQLService extends ConfluenceClient
{
    public $uri = '/api/content/search';

    public function search($query, $expands = [], $start = NULL, $limit = NULL)
    {
        $queryParam = '?' . 'cql=' . urlencode($query);

        if (is_array($expands) && count($expands) > 0)
            $queryParam .= "&expand=" . implode(",", $expands);

        if ($start !== NULL)
            $queryParam .= "&start=" . intval($start);

        if ($limit !== NULL)
            $queryParam .= "&limit=" . intval($limit);

        $ret = $this->exec($this->uri . $queryParam, null);

        return $searchResults = $this->json_mapper->map(
            json_decode($ret), new CQLSearchResults()
        );
    }
}