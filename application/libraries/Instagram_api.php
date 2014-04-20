<?php

/**
 * CodeIgniter Instagram Library by Ian Luckraft	http://ianluckraft.co.uk	ian@ianluckraft.co.uk
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   Instagram
 * @package    CodeIgniter
 * @subpackage Client
 * @version    1.0
 * @license    http://www.gnu.org/licenses/     GNU General Public License
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instagram_api {

	/*
	 * Variable to hold an insatance of CodeIgniter so we can access CodeIgniter features
	 */
	protected $codeigniter_instance;

	/*
	 * Create an array of the urls to be used in api calls
	 * The urls contain conversion specifications that will be replaced by sprintf in the functions
	 * @var string
	 */
    protected $api_urls = array(
    	'user'						=> 'https://api.instagram.com/v1/users/%s/?access_token=%s',
        'user_feed'					=> 'https://api.instagram.com/v1/users/self/feed?access_token=%s&count=%s&femax_id=%s&min_id=%s',
        'user_recent'				=> 'https://api.instagram.com/v1/users/%s/media/recent/?access_token=%s&count=%s&max_id=%s&min_id=%s&max_timestamp=%s&min_timestamp=%s',
        'user_search'				=> 'https://api.instagram.com/v1/users/search?q=%s&access_token=%s',
        'user_follows'				=> 'https://api.instagram.com/v1/users/%s/follows?access_token=%s',
        'user_followed_by'			=> 'https://api.instagram.com/v1/users/%s/followed-by?access_token=%s',
        'user_requested_by'			=> 'https://api.instagram.com/v1/users/self/requested-by?access_token=%s',
        'user_relationship'			=> 'https://api.instagram.com/v1/users/%s/relationship?access_token=%s',
        'modify_user_relationship'	=> 'https://api.instagram.com/v1/users/%s/relationship?access_token=%s',
        'media'						=> 'https://api.instagram.com/v1/media/%s?access_token=%s',
        'media_search'				=> 'https://api.instagram.com/v1/media/search?lat=%s&lng=%s&max_timestamp=%s&min_timestamp=%s&distance=%s&access_token=%s',
        'media_popular'				=> 'https://api.instagram.com/v1/media/popular?access_token=%s',
        'media_comments'			=> 'https://api.instagram.com/v1/media/%s/comments?access_token=%s',
        'post_media_comment'		=> 'https://api.instagram.com/v1/media/%s/comments?access_token=%s',
        'delete_media_comment'		=> 'https://api.instagram.com/v1/media/%s/comments?comment_id=%s&access_token=%s',
        'likes'						=> 'https://api.instagram.com/v1/media/%s/likes?access_token=%s',
    	'post_like'					=> 'https://api.instagram.com/v1/media/%s/likes?access_token=%s',
        'remove_like'				=> 'https://api.instagram.com/v1/media/%s/likes?access_token=%s',
        'tags'						=> 'https://api.instagram.com/v1/tags/%s?access_token=%s',
        'tags_recent'				=> 'https://api.instagram.com/v1/tags/%s/media/recent?max_id=%s&min_id=%s&access_token=%s',
        'tags_search'				=> 'https://api.instagram.com/v1/tags/search?q=%s&access_token=%s',
        'locations'					=> 'https://api.instagram.com/v1/locations/%d?access_token=%s',
        'locations_recent'			=> 'https://api.instagram.com/v1/locations/%d/media/recent/?max_id=%s&min_id=%s&max_timestamp=%s&min_timestamp=%s&access_token=%s',
        'locations_search'			=> 'https://api.instagram.com/v1/locations/search?lat=%s&lng=%s&foursquare_id=%s&distance=%s&access_token=%s',
		'geographies' 				=> 'https://api.instagram.com/v1/geographies/%s/media/recent?client_id=%s'
    );
    
    /*
     * Construct function
     * Sets the codeigniter instance variable and loads the lang file
     */
    function __construct() {
    
    	// Set the CodeIgniter instance variable
    	$this->codeigniter_instance =& get_instance();
    	
    	// Load the Instagram API language file
    	$this->codeigniter_instance->load->config('Instagram_api');
    
    } 
    
    /*
     * Create a variable to hold the Oauth access token
     * @var string
     */
    public $access_token = FALSE;
    
    /*
     * Function to create the login with Instagram link
     * @return string Instagram login url
     */
    function instagramLogin() {
      
      $login_url = 'https://api.instagram.com/oauth/authorize/?client_id=' . $this->codeigniter_instance->config->item('instagram_client_id');
      $login_url .= '&redirect_uri=' . $this->codeigniter_instance->config->item('instagram_callback_url');
      $login_url .= '&response_type=code';
      $login_url .= '&scope=' . $this->codeigniter_instance->config->item('instagram_scope');
    
    	return $login_url;
    
    }
    
    /*
     * The api call function is used by all other functions
     * It accepts a parameter of the url to use
     * And an optional string of post parameters
     * @param string api url
     * @param array post parameters for curl call
     * @return std_class data returned form curl call
     */
    function __apiCall($url, $post_parameters = FALSE) {
    
    	// Initialize the cURL session
	    $curl_session = curl_init();
	    	
	    // Set the URL of api call
		curl_setopt($curl_session, CURLOPT_URL, $url);
		    
		// If there are post fields add them to the call
		if($post_parameters !== FALSE) {
			curl_setopt ($curl_session, CURLOPT_POSTFIELDS, $post_parameters);
		}
		    
		// Return the curl results to a variable
	    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, 1);
	    
	    // There was issues with some servers not being able to retrieve the data through https
	    // The config variable is set to TRUE by default. If you have this problem set the config variable to FALSE
	    // See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
	    curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, $this->codeigniter_instance->config->item('instagram_ssl_verify'));
		    
	    // Execute the cURL session
	    $contents = curl_exec ($curl_session);
		    
		// Close cURL session
		curl_close ($curl_session);
		    
		// Return the response
		return json_decode($contents);
    
    }
    
    /*
     * The authorize function to get the OAuth token
     * Accepts a code that is returned from Instagram to our redirect url
     * @param string code generated by Instagram when the user has been sent to our redirect url
     * @return std_class Instagram OAuth data
     */
	function authorize($code)
	{
	
		$authorization_url = 'https://api.instagram.com/oauth/access_token';
		
		return $this->__apiCall($authorization_url, "client_id=" . $this->codeigniter_instance->config->item('instagram_client_id') . "&client_secret=" . $this->codeigniter_instance->config->item('instagram_client_secret') . "&grant_type=authorization_code&redirect_uri=" . $this->codeigniter_instance->config->item('instagram_callback_url') . "&code=" . $code);		
		
	}
    
    /*
     * Get a list of what media is most popular at the moment
     * This function only requires your instagram client id and no Oauth token
     * @return std_class current popular media with associated data
     */
    function getPopularMedia()
    {
        
    	$popular_media_request_url = 'https://api.instagram.com/v1/media/popular?client_id=' . $this->codeigniter_instance->config->item('instagram_client_id');
    	
    	return $this->__apiCall($popular_media_request_url);
        
    }
    
    /*
     * Get an individual user's details
     * Accepts a user id
     * @param int Instagram user id
     * @return std_class data about the Instagram user
     */
    function getUser($user_id) {
    	
    	$user_request_url = sprintf($this->api_urls['user'], $user_id, $this->access_token);
    	
    	return $this->__apiCall($user_request_url);
    	
    }
    
    /*
     * Get an individual user's feed
     * Accepts optional max and min values
     * @param int return media after max id
     * @param int return media before min id
     * @return std_class of user's feed
     */
    function getUserFeed($count = null, $max = null, $min = null) {
    	
    	$user_feed_request_url = sprintf($this->api_urls['user_feed'], $this->access_token, $count, $max, $min);
    	
    	return $this->__apiCall($user_feed_request_url);
    	
    }
    
    /*
     * Function to get a users recent published media
     * Accepts a user id and access token and optional max id, min id, max timestamp and min timestamp
     * @param int Instagram user id
     * @param int return media after max id
     * @param int return media before min id
     * @param int return media after this UNIX timestamp
     * @param int return media before this UNIX timestamp
     * @param int return this number of media
     * @return std_class of media found based on parameters given
     */
    function getUserRecent($user_id, $max_id = null, $min_id = null, $max_timestamp = null, $min_timestamp = null, $count = null) {
    	
    	$user_recent_request_url = sprintf($this->api_urls['user_recent'], $user_id, $this->access_token, $count, $max_id, $min_id, $max_timestamp, $min_timestamp);
    	
    	return $this->__apiCall($user_recent_request_url);
    	
    }
    
    /*
     * Function to search for user
     * Accepts a user name to search for
     * @param string an Instagram user name
     * @return std_class user data
     */
    function userSearch($user_name) {
    	
    	$user_search_request_url = sprintf($this->api_urls['user_search'], $user_name, $this->access_token);
    	
    	return $this->__apiCall($user_search_request_url);
    	
    }
    
    /*
     * Function to get all users the current user follows
     * Accepts a user id
     * @param int user id
     * @return std_class user's recent feed items
     */
    function userFollows($user_id) {
    	
    	$user_follows_request_url = sprintf($this->api_urls['user_follows'], $user_id, $this->access_token);
    	
    	return $this->__apiCall($user_follows_request_url);
    	
    }
    
    /*
     * Function to get all users the current user follows
     * Accepts a user id
     * @param int user id
     * @return std_class other users that follow the one passed in
     */
    function userFollowedBy($user_id) {
    	
    	$user_followed_by_request_url = sprintf($this->api_urls['user_followed_by'], $user_id, $this->access_token);
    	
    	return $this->__apiCall($user_followed_by_request_url);
    	
    }
    
    /*
     * Function to find who a user was requested by
     * Accepts an access token
     * @return std_class users who have requested this user's permission to follow
     */
    function userRequestedBy() {
    	
    	$user_requested_by_request_url = sprintf($this->api_urls['user_requested_by'], $this->access_token);
    	
    	return $this->__apiCall($user_requested_by_request_url);
    	
    }
    
    /*
     * Function to get information about the current user's relationship (follow/following/etc) to another user
     * @param int user id
     * @return std_class user's relationship to another user
     */
    function userRelationship($user_id) {
    	
    	$user_relationship_request_url = sprintf($this->api_urls['user_relationship'], $user_id, $this->access_token);
    	
    	return $this->__apiCall($user_relationship_request_url);
    	
    }
    
	/*
     * Function to modify the relationship between the current user and the target user
     * @param int Instagram user id
     * @param string action to effect relatonship (follow/unfollow/block/unblock/approve/deny)
     * @return std_class result of request
     */
    function modifyUserRelationship($user_id, $action) {
    	
    	$user_modify_relationship_request_url = sprintf($this->api_urls['modify_user_relationship'], $user_id, $this->access_token);
    	
    	return $this->__apiCall($user_modify_relationship_request_url, array("action" => $action));
    	
    }
    
    /*
     * Function to get data about a media id
     * Accepts a media id
     * @param int media id
     * @return std_class data about the media item
     */
    function getMedia($media_id) {
    	
    	$media_request_url = sprintf($this->api_urls['media'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($media_request_url);
    	
    }
    
    /*
     * Function to search for media
     * Accepts optional parameters
     * @param int latitude
     * @param int longitude
     * @param int max timestamp
     * @param int min timestamp
     * @param int distance
     * @return std_class media items found in search
     */
    function mediaSearch($latitude = null, $longitude = null, $max_timestamp = null, $min_timestamp = null, $distance = null) {
    	
    	$media_search_request_url = sprintf($this->api_urls['media_search'], $latitude, $longitude, $max_timestamp, $min_timestamp, $distance, $this->access_token);
    	
    	return $this->__apiCall($media_search_request_url);
    	
    }
    
    /*
     * Function to get a list of what media is most popular at the moment
     * @return std_class popular media
     */
    function popularMedia() {
    	
    	$popular_media_request_url = sprintf($this->api_urls['media_popular'], $this->access_token);
    	
    	return $this->__apiCall($popular_media_request_url);
    	
    }
    
    /*
     * Function to gget a full list of comments on a media
     * @param int media id
     * @return std_class media comments
     */
    function mediaComments($media_id) {
    
    	$media_comments_request_url = sprintf($this->api_urls['media_comments'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($media_comments_request_url);
    
    }
    
    /*
     * Function to post a media comment
     * @param int media id
     * @param string comment on the media
     * @return std_class response to request
     */
    function postMediaComment($media_id, $comment) {
    
    	$post_media_comment_url = sprintf($this->api_urls['post_media_comment'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($post_media_comment_url, array('text' => $comment));    	
    
    }
    
    /*
     * Function to delete a media comment
     * @param int media id
     * @param int comment id
     * @return std_class response to request
     */
    function deleteMediaComment($media_id, $comment_id) {
    
    	$delete_media_comment_url = sprintf($this->api_urls['delete_media_comment'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($delete_media_comment_url);
    
    }
    
    /*
     * Function to get a list of users who have liked this media
     * @param int media id
     * @return std_class list of users
     */
    function mediaLikes($media_id) {
    
    	$media_likes_request_url = sprintf($this->api_urls['likes'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($media_likes_request_url);
    
    }
    
    /*
     * Function to post a like for a media item
     * @param int media id
     * @return std_class response to request
     */
    function postLike($media_id) {
    
        $post_media_like_request_url = sprintf($this->api_urls['post_like'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($post_media_like_request_url, TRUE);
    
    }

	/*
	 * Function to remove a like for a media item
	 * @param int media id
	 * @return std_class response to request
	 */
    function removeLike($media_id) {
    
    	$remove_like_request_url = sprintf($this->api_urls['remove_like'], $media_id, $this->access_token);
    	
    	return $this->__apiCall($remove_like_request_url);
    	
    }
    
    /*
     * Function to get information about a tag object
     * @param string tag
     * @return std_class of data about the tag
     */
    function getTags($tag) {
    
    	$tags_request_url = sprintf($this->api_urls['tags'], $tag, $this->access_token);
    	
    	return $this->__apiCall($tags_request_url);
    
    }
    
    /*
     * Function to get a list of recently tagged media
     * @param string tag
     * @param int return media after this max_id
     * @param int return media before this min_id
     * @return std_class recently tagged media
     */
    function tagsRecent($tag, $max_id = null, $min_id = null) {
    
    	$tags_recent_request_url = sprintf($this->api_urls['tags_recent'], $tag, $max_id, $min_id, $this->access_token);
    	
    	return $this->__apiCall($tags_recent_request_url);
    
    }
    
	/*
     * Function to search for tagged media
     * @param string valid tag name without a leading #. (eg. snow, nofilter)
     * @return std_class tags by name - results are ordered first as an exact match, then by popularity
     */
    function tagsSearch($tag) {
    
    	$tags_search_request_url = sprintf($this->api_urls['tags_search'], $tag, $this->access_token);
    	
    	return $this->__apiCall($tags_search_request_url);
    
    }
    
    /*
     * Function to get information about a location. 
     * @param int location id
     * @return std_class data about the location
     */
    function getLocation($location) {
    
    	$location_request_url = sprintf($this->api_urls['locations'], $location, $this->access_token);
    	
    	return $this->__apiCall($location_request_url);
    
    }
    
    /*
     * Function to get a list of recent media objects from a given location.
     * @param int location id
     * @param int return media after this max_id
     * @param int return media before this min_id
     * @param int return media after this UNIX timestamp
     * @param int return media before this UNIX timestamp
     * @return std_class recent media objects from a location
     */
    function locationRecent($location, $max_id = null, $min_id = null, $max_timestamp = null, $min_timestamp = null) {
    
    	$location_recent_request_url = sprintf($this->api_urls['locations_recent'], $location, $max_id, $min_id, $max_timestamp, $min_timestamp, $this->access_token);
    	
    	return $this->__apiCall($location_recent_request_url);
    
    }
    
    /*
     * Function to search for locations used in Instagram
     * @param int latitude of the center search coordinate. If used, longitude is required
     * @param int longitude of the center search coordinate. If used, latitude is required
     * @param int Foursquare id. Returns a location mapped off of a foursquare v1 api location id. If used, you are not required to use lat and lng. Note that this method will be deprecated over time and transitioned to new foursquare IDs with V2 of their API.
     * @param int distance. Default is 1000m (distance=1000), max distance is 5000
     * @return std_class location data
     */
    function locationSearch($latitude = null, $longitude = null, $foursquare_id = null, $distance = null) {
    
    	$location_search_request_url = sprintf($this->api_urls['locations_search'], $latitude, $longitude, $foursquare_id, $distance, $this->access_token);
    	
    	return $this->__apiCall($location_search_request_url);
    
    }
	
    /*
     * Get recent media from a geography subscription that was created
     * @param string geography code returned when subscribing to a specific location
     * @param string client id provided by instagram api
     * @return std_class media posts of a specific geography
     */	
	function geographies($geo_code,$client_id)
	{
		$geographies_media_specific = sprintf($this->api_urls['geographies'],$geo_code,$client_id);
		
    	return $this->__apiCall($geographies_media_specific);
	}	

}
