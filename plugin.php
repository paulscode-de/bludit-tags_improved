<?php

class pluginTagsPlus extends Plugin {

    public function init() {
        $this->dbFields = array(
            'label' => 'Tags',
            'tags-1' => '1',
            'tags-2' => '4',
            'tags-3' => '8',
            'tags-4' => '13',
            'tags-0-class' => 'tags-0',
            'tags-1-class' => 'tags-1',
            'tags-2-class' => 'tags-2',
            'tags-3-class' => 'tags-3',
            'tags-4-class' => 'tags-4'
        );
    }

    public function form() {
        global $L;

        $html = '<div class="alert alert-primary" role="alert">';
        $html .= $this->description();
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label>' . $L->get('Label') . '</label>';
        $html .= '<input id="jslabel" name="label" type="text" value="' . $this->getValue('label') . '">';
        $html .= '<span class="tip">' . $L->get('This title is almost always used in the sidebar of the site') . '</span>';
        $html .= '</div>';

        $html .= '<h1>Class Settings for Tags</h1>';
        $html .= '<h2>Base Tag</h2>';
        $html .= '<div class="tags_improved_step">';
        $html .= '<label>' . $L->get('Base Class to use:') . '</label>';
        $html .= '<input id="jslabel" name="tags-0-class" type="text" value="' . $this->getValue('tags-0-class') . '">';
        $html .= '</div>';

        $html .= '<h2>1. Tag</h2>';
        $html .= '<div class="tags_improved_step">';
        $html .= '<label>' . $L->get('Should be used if amount is greater than:') . '</label>';
        $html .= '<input id="jslabel" name="tags-1" type="text" value="' . $this->getValue('tags-1') . '">';
        $html .= '<label>' . $L->get('Class to use:') . '</label>';
        $html .= '<input id="jslabel" name="tags-1-class" type="text" value="' . $this->getValue('tags-1-class') . '">';
        $html .= '</div>';

        $html .= '<h2>2. Tag</h2>';
        $html .= '<div class="tags_improved_step">';
        $html .= '<label>' . $L->get('Should be used if amount is greater than:') . '</label>';
        $html .= '<input id="jslabel" name="tags-2" type="text" value="' . $this->getValue('tags-2') . '">';
        $html .= '<label>' . $L->get('Class to use:') . '</label>';
        $html .= '<input id="jslabel" name="tags-2-class" type="text" value="' . $this->getValue('tags-2-class') . '">';
        $html .= '</div>';

        $html .= '<h2>3. Tag</h2>';
        $html .= '<div class="tags_improved_step">';
        $html .= '<label>' . $L->get('Should be used if amount is greater than:') . '</label>';
        $html .= '<input id="jslabel" name="tags-3" type="text" value="' . $this->getValue('tags-3') . '">';
        $html .= '<label>' . $L->get('Class to use:') . '</label>';
        $html .= '<input id="jslabel" name="tags-3-class" type="text" value="' . $this->getValue('tags-3-class') . '">';
        $html .= '</div>';

        $html .= '<h2>4. Tag</h2>';
        $html .= '<div class="tags_improved_step">';
        $html .= '<label>' . $L->get('Should be used if amount is greater than:') . '</label>';
        $html .= '<input id="jslabel" name="tags-4" type="text" value="' . $this->getValue('tags-4') . '">';
        $html .= '<label>' . $L->get('Class to use:') . '</label>';
        $html .= '<input id="jslabel" name="tags-4-class" type="text" value="' . $this->getValue('tags-4-class') . '">';
        $html .= '</div>';

        $html .= '<style type="text/css" media="screen">
	      .tags_improved_step{ margin-left: 15px; }
	      </style>';

        return $html;
    }

    public function siteHead() {
        return $this->includeCSS('tags_improved.css');
    }

    public function siteSidebar() {
        global $L;
        global $tags;
        global $url;

        $filter = $url->filters('tag');

        $html = '<div class="plugin plugin-tags">';
        $html .= '<h2 class="plugin-label">' . htmlentities($this->getValue('label')) . '</h2>';
        $html .= '<div class="plugin-content">';
        $html .= '<ul class="tags">';

        // By default the database of tags are alphanumeric sorted
        foreach ($tags->db as $key => $fields) {
            $fontSize = "";
            $fontWeight = "400";

            $tagCount = count($fields['list']);


            if ($tagCount > $this->getValue('tags-4')) {
                $classToUse = $this->getValue('tags-4-class');;
            } else if ($tagCount > $this->getValue('tags-3')) {
                $classToUse = $this->getValue('tags-3-class');;
            } else if ($tagCount > $this->getValue('tags-2')) {
                $classToUse = $this->getValue('tags-2-class');;
            } else if ($tagCount > $this->getValue('tags-1')) {
                $classToUse = $this->getValue('tags-1-class');;
            } else {
                $classToUse = $this->getValue('tags-0-class');
            }

            $html .= '<li class="' . htmlentities($classToUse) . '" ">';

            $html .= '<a href="' . DOMAIN_TAGS . htmlentities($key) . '">';
            $html .= htmlentities($fields['name']);
            $html .= '</a>';
            $html .= '</li>';
        }

        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
