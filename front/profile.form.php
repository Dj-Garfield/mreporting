<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 Mreporting plugin for GLPI
 Copyright (C) 2003-2011 by the mreporting Development Team.

 https://forge.indepnet.net/projects/mreporting
 -------------------------------------------------------------------------

 LICENSE

 This file is part of mreporting.

 mreporting is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 mreporting is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with mreporting. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

include ("../../../inc/includes.php");

//Session::checkRight("profile","r");

//Save profile
if (isset ($_POST['update'])) {

    $config = new PluginMreportingConfig();
    $res = $config->find();

    foreach( $res as $report) {

        $access = $_POST[$report['id']];
        $idReport = $report['id'];
        $idProfil = $_POST['profile_id'];

        $profil = new PluginMreportingProfile();
        $profil->getFromDBByQuery("where profiles_id = ".$idProfil." and reports = ".$idReport);
        $profil->fields['right'] = $access;
        $profil->update($profil->fields);

    }

	Html::back();

}else if (isset ($_POST['add'])) {

    global $DB;

    $query = "SELECT `id`, `name`
                FROM `glpi_profiles` where `interface` = 'central'
                ORDER BY `name`";

    foreach ($DB->request($query) as $profile) {

        $access = $_POST[$profile['id']];
        $idProfil = $profile['id'];
        $idReport = $_POST['report_id'];

        $profil = new PluginMreportingProfile();
        $profil->getFromDBByQuery("where profiles_id = ".$idProfil." and reports = ".$idReport);
        $profil->fields['right'] = $access;
        $profil->update($profil->fields);

    }

    Html::back();

}else if (isset($_POST['giveReadAccessForAllReport'])){

    $config = new PluginMreportingConfig();
    $res = $config->find();

    foreach( $res as $report) {

        $idReport = $report['id'];
        $idProfil = $_POST['profile_id'];

        $profil = new PluginMreportingProfile();
        $profil->getFromDBByQuery("where profiles_id = ".$idProfil." and reports = ".$idReport);
        $profil->fields['right'] = 'r';
        $profil->update($profil->fields);

    }

    Html::back();

}else if (isset($_POST['giveNoneAccessForAllReport'])){

    $config = new PluginMreportingConfig();
    $res = $config->find();

    foreach( $res as $report) {

        $idReport = $report['id'];
        $idProfil = $_POST['profile_id'];

        $profil = new PluginMreportingProfile();
        $profil->getFromDBByQuery("where profiles_id = ".$idProfil." and reports = ".$idReport);
        $profil->fields['right'] = 'null';
        $profil->update($profil->fields);

    }

    Html::back();

}else if (isset($_POST['giveNoneAccessForAllProfile'])){

    global $DB;

    $query = "SELECT `id`, `name`
                FROM `glpi_profiles` where `interface` = 'central'
                ORDER BY `name`";

    foreach ($DB->request($query) as $profile) {

        $idProfil = $profile['id'];
        $idReport = $_POST['report_id'];

        $profil = new PluginMreportingProfile();
        $profil->getFromDBByQuery("where profiles_id = ".$idProfil." and reports = ".$idReport);
        $profil->fields['right'] = 'null';
        $profil->update($profil->fields);

    }

    Html::back();

}else if (isset($_POST['giveReadAccessForAllProfile'])){

    global $DB;

    $query = "SELECT `id`, `name`
                FROM `glpi_profiles` where `interface` = 'central'
                ORDER BY `name`";

    foreach ($DB->request($query) as $profile) {

        $idProfil = $profile['id'];
        $idReport = $_POST['report_id'];

        $profil = new PluginMreportingProfile();
        $profil->getFromDBByQuery("where profiles_id = ".$idProfil." and reports = ".$idReport);
        $profil->fields['right'] = 'r';
        $profil->update($profil->fields);

    }

    Html::back();

}

