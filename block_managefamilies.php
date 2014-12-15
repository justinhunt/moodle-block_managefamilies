<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   block_managefamilies
 * @copyright Justin Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_managefamilies extends block_base {


    function init() {
        $this->title = get_string('pluginname', 'block_managefamilies');
    }

    function get_content() {
        global $USER, $DB,$CFG, $SESSION, $OUTPUT;
        if ($this->content !== NULL) {
            return $this->content;
        }
        $this->content = new stdClass();
        $this->content->footer = '';
       
       //if user doesn't have permission to use this, don't show it.
       	$systemcontext = context_system::instance();
       	if(!has_capability('local/family:managefamilies',$systemcontext)){
       		return $this->content;
       	}
        
        //links for the family actions
        $managefamilies = $CFG->wwwroot."/local/family/view.php?action=listall";
        $searchfamily = $CFG->wwwroot."/local/family/view.php?action=searchfamily";
        $addfamily = $CFG->wwwroot."/local/family/view.php?action=addfamily";
        $uploadfile = $CFG->wwwroot."/local/family/view.php?action=uploadfile";
        $exportfamilies = $CFG->wwwroot."/local/family/exportfamilies.php";
        
        
        //the output html
        $html ='';
		$html .=html_writer::link($managefamilies, get_string('managefamilies', 'local_family')) . '<br />';
		$html .= html_writer::link($searchfamily, get_string('searchfamilies', 'local_family')) . '<br />';
		$html .= html_writer::link($addfamily, get_string('addfamily', 'local_family')) . '<br />';
		$html .= html_writer::link($uploadfile, get_string('uploadfamilies', 'local_family')) . '<br />';
		$html .= html_writer::link($exportfamilies, get_string('exportfamilies', 'local_family')) . '<br />';
        $this->content->text = $html;
        return $this->content;
    }

}
