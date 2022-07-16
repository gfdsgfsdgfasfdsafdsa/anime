<?php
class HomeModel extends Model {
    public function getAnimeLimit($start, $end, $query = '', $order = ''){
        return $this->db->query("select title,slug,posterLink,titleKeywords,count(e.id) as episodeCount from anime a left join episode e on a.slug = e.animeSlug ".$query." group by a.slug ".$order." limit {$start},{$end}");
    }

    public function getAnimeCount($query = ''){
        return $this->db->query('select count(id) as count from anime a '. $query)[0]->count;
    }

    public function minMaxYear(){
        return [
            $this->db->query('select EXTRACT(YEAR FROM (select min(dateFrom) from anime)) as minYear')[0],
            $this->db->query('select EXTRACT(YEAR FROM (select max(dateFrom) from anime)) as maxYear')[0]
            ];
    }

    public function recentlyAdded($start, $end){
        return $this->db->query("select title,slug,posterLink,titleKeywords,(select count(ep.id) from anime an,episode ep where an.slug = ep.animeSlug and an.slug = a.slug group by ep.animeSlug) as episodeCount from anime a left join episode e on a.slug = e.animeSlug where e.id in (select max(id) from episode group by animeSlug) group by a.slug order by e.id desc limit {$start},{$end}");
    }

    public function recentCount(){
        return $this->db->query("select count(e.id) as count from anime a, episode e where a.slug = e.animeSlug and e.id in (select max(id) from episode group by animeSlug)")[0]->count;
    }
}
