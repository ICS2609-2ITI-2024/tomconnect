<?php
declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\TagModel;

class Search extends Controller
{
    private $posts = [];
    private $tags = [];

    private $orgs = [];

    private $org_ids = [];

    public function search()
    {
        return $this->generate_results();
    }

    private function generate_results()
    {
        $this->set_org_ids();
        $this->set_posts();
        $this->set_orgs();
        $this->remove_duplicates();

        return array(
            'posts' => $this->posts,
            'organizations' => $this->orgs,
        );
    }

    private function search_posts()
    {
        return PostModel::search($_GET['q']);
    }

    private function search_organizations()
    {
        return OrganizationModel::search($_GET['q']);
    }

    private function remove_duplicates()
    {
        $hash_map = [];

        foreach($this->posts as $post) {
            $hash_map[$post['post_id']] = $post;
        }

        $this->posts = array_values($hash_map);
    }

    private function set_posts()
    {
        foreach(PostModel::search($_GET['q']) as $post) {
            $this->posts[] = $post;
        }

        foreach($this->org_ids as $org_id) {
            foreach(PostModel::search_from_column('author_id', $org_id) as $post) {
                $this->posts[] = $post;
            }
        }
    }

    private function set_org_ids()
    {
        foreach($this->search_organizations() as $org) {
            $this->org_ids[] = $org['org_id'];
        }
    }

    private function set_orgs() {
        $this->orgs = $this->search_organizations();
    }
}