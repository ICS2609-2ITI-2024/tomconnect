<?php

/**
 * The Search class handles the searching functionality for posts and organizations within the application.
 *
 * This class allows users to search for posts and organizations based on a query string parameter 'q'.
 * It provides methods to initiate the search process, retrieve search results, and handle data processing.
 *
 * @package Tomconnect\Controllers
 */

declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\TagModel;

class Search extends Controller
{
    /** @var array Holds the search results for posts. */
    private $posts = [];

    /** @var array Holds the search results for organizations. */
    private $orgs = [];

    /** @var array Holds the IDs of organizations retrieved from the search results. */
    private $org_ids = [];

    /**
     * Initiates the search process and generates results based on the query string parameter 'q'.
     *
     * If the 'q' parameter is not set in the $_GET superglobal, an empty array is returned.
     *
     * @return array An associative array containing search results for posts and organizations.
     */
    public function search()
    {
        if (!isset($_GET['q'])) {
            return array();
        }
        return $this->generate_results();
    }

    /**
     * Generates search results for posts and organizations based on the query string parameter 'q'.
     *
     * @return array An associative array containing search results for posts and organizations.
     */
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

    /**
     * Removes duplicate posts from the search results.
     */
    private function remove_duplicates()
    {
        $hash_map = [];

        foreach ($this->posts as $post) {
            $hash_map[$post['post_id']] = $post;
        }

        $this->posts = array_values($hash_map);
    }

    /**
     * Sets the posts array with search results from both direct post search and organization-wise post search.
     */
    private function set_posts()
    {
        foreach (PostModel::search($_GET['q']) as $post) {
            $this->posts[] = $post;
        }

        foreach ($this->org_ids as $org_id) {
            foreach (PostModel::search_from_column('author_id', $org_id) as $post) {
                $this->posts[] = $post;
            }
        }
    }

    /**
     * Sets the organization IDs array based on the search results.
     */
    private function set_org_ids()
    {
        foreach (OrganizationModel::search($_GET['q']) as $org) {
            $this->org_ids[] = $org['org_id'];
        }
    }

    /**
     * Sets the organizations array with search results.
     */
    private function set_orgs()
    {
        $this->orgs = OrganizationModel::search($_GET['q']);
    }
}
