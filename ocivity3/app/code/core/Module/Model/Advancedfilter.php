<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 11/19/15
 * Time: 21:18
 */

class ModelModuleAdvancedFilter extends Model
{
    private $filters = array(
        'prices_range',
        'category_ids',
        'manufacturer_ids',
        'option_ids'
    );
    public function getFilteringData($request)
    {
        if (isset($request['route']) && $request['route'] == 'product/category')
        {
            return $this->_getFilteringDataOnCategory($request);
        }
        else if(isset($request['route']) && $request['route'] == 'product/search')
        {
            return $this->_getFilteringDataOnCategory($request);
        }
    }

    public function getFilterParams($request)
    {
        $filters = $this->filters;

        $data = array();
        foreach ($filters as $filter)
        {
            if (isset($request[$filter])) {
                $data['filter_'.$filter] = $request[$filter];
            } else {
                $data['filter_'.$filter] = false;
            }
        }

        return $data;
    }

    public function getUrlSortParams($request, &$url)
    {
        $filters = $this->filters;

        foreach ($filters as $filter)
        {
            if (isset($request[$filter])) {
                $url .= '&'.$filter.'=' . $request[$filter];
            }
        }
    }

    protected function _getFilteringDataOnCategory($request)
    {
        # Process like controller category
        if (isset($request['filter'])) {
            $filter = $request['filter'];
        } else {
            $filter = '';
        }

        if (isset($request['sort'])) {
            $sort = $request['sort'];
        } else {
            $sort = 'p.sort_order';
        }

        if (isset($request['order'])) {
            $order = $request['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($request['path'])) {
            $parts = explode('_', (string)$request['path']);

            $category_id = (int)array_pop($parts);
        } else {
            $category_id = 0;
        }

        $filter_data = array(
            'filter_category_id' => $category_id,
            'filter_filter'      => $filter,
            'sort'               => $sort,
            'order'              => $order,
        );

        return $filter_data;
    }

    protected function _getFilteringDataOnSearch()
    {
        return false;
    }
}