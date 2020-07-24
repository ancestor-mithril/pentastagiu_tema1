<?php
    class PublisherView extends View
    {
        public function createNewEntryFormular(): string {
            $formular = '<div class="add_form"><form action="' . WSITE_ROOT . '/publisher/store" method="POST">';
            $formular .= '<label for="name">Name:</label><br>';
            $formular .= '<input type="text" id="name" name="name" value="default name"><br><br>';
            $formular .= '<input type="submit" value="Submit"><br>';
            $formular .= "</form></div>";
            return $formular;
        }

        private function displayPublishers(array $publishers): string {
            $currentPublishers = "<div>";
            foreach ($publishers as $publisher) 
            {
                $currentPublishers .= '<div class="publishers">';
                $currentPublishers .= '<h4>Publisher ' . $publisher["id"] . '</h6>';
                $currentPublishers .= '<p>Title: ' . $publisher["name"] . '</p>';
                $currentPublishers .= '<form action="' . WSITE_ROOT . '/publisher/delete" method="POST"><input type="hidden" 
                    name="id" value="' . $publisher["id"] . '"><input type="Submit" value="Delete"></form>';
                $currentPublishers .= '<form action="' . WSITE_ROOT . '/publisher/edit" method="GET"><input type="hidden" 
                    name="id" value="' . $publisher["id"] . '"><input type="Submit" value="Edit"></form>';
                $currentPublishers .= '</div>';
                
            }
            $currentPublishers .= '</div><form action="' . WSITE_ROOT . '/publisher/create" method="POST">
                <input type=Submit value="Add new publisher"></form><br>';
            $currentPublishers .= '</div><form action="' . WSITE_ROOT . '/book" method="POST">
                <input type=Submit value="Go to books"></form><br>';
            $currentPublishers .= '</div><form action="' . WSITE_ROOT . '/author" method="POST">
                <input type=Submit value="Go to authors"></form><br>';
            return $currentPublishers;
        }

        public function createPublisherPage(array $publishers): string {
            $currentPublishers = $this->displayPublishers ($publishers);
            ob_start();
            $publisherPage = "views/TPL/publisher_page.html";
            include ($publisherPage);
            $page = ob_get_contents();
            ob_end_clean();
            return $page;
        }

        public function createEditFormular(array $publisher): string {
            $formular = '<form action="' . WSITE_ROOT . '/publisher/update" method="POST">';
            $formular .= '<label for="name">Name:</label><br>';
            $formular .= '<input type="hidden" id="id" name="id" value="' . $publisher["id"] . '"><br>';
            $formular .= '<input type="text" id="name" name="name" value="' . $publisher["name"] . '"><br>';
            $formular .= '<input type="submit" value="Submit"><br>';
            $formular .= "</form>";
            return $formular;
        }
    }