<?php

require_once 'PageModel.php';

class PageController {
    private $model;

    public function __construct() {
        $this->model = new PageModel();
    }

    public function displayPage($pageId) {
        $pageData = $this->model->getPageContent($pageId);
        include 'pageView.php';
    }
}

// Usage:
$pageId = isset($_GET['page']) ? $_GET['page'] : 1; // Default page ID is 1 (Home)
$controller = new PageController();
$controller->displayPage($pageId);

?>
