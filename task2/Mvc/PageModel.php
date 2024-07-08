<?php

class PageModel {
    public function getPageContent($pageId) {
        // Example: Fetch content based on $pageId from a database
        // For simplicity, we use a hardcoded array here
        $pages = [
            1 => ['title' => 'Home', 'content' => 'Welcome to our website.'],
            2 => ['title' => 'About Us', 'content' => 'Learn more about our company.'],
            3 => ['title' => 'Contact', 'content' => 'Get in touch with us.']
        ];

        // Check if $pageId exists in array
        if (array_key_exists($pageId, $pages)) {
            return $pages[$pageId];
        } else {
            return ['title' => 'Not Found', 'content' => 'Page not found.'];
        }
    }
}
?>
