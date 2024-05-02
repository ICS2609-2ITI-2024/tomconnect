<?php
declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\TagModel;

class search extends Controller
{
    private $posts = [];
    private $tags = [];

    private $orgs = [];

    public function search($query)
    {
    }

    private function search_posts()
    {
        return PostModel::search($_GET['q']);
    }

    private function search_organizations()
    {
        // return OrganizationModel::search();
    }
}