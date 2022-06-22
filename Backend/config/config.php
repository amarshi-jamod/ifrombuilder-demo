<?php
    $CK = '6f14d1f15f6c2e639b655db53feb0f8be352b7c4'; /* Update this from IFormBuilder */
    $CS = '343ac6153fb57b632eae1856d72131e649071cd9'; /* Update this from IFormBuilder */
    $PageId = '290841373'; /* Update this from IFormBuilder */
    $ProfileId = '372877'; /* Update this from IFormBuilder */
    $apiUrl = 'https://loadapp.iformbuilder.com/exzact/api/'; /* Update this from IFormBuilder */

    define("CLIENT_KEY", $CK);
    define("CLIENT_SECRET", $CS);
    define("AUD_VALUE", $apiUrl."oauth/token");
    define("PAGE_ID", $PageId);
    define("PROFILE_ID", $ProfileId);
    define("EXPIRE_TIME", 600);
    define("RECORDURL", $apiUrl."v60/profiles/".PROFILE_ID."/pages/".PAGE_ID."/records");

    include __DIR__.'/../helpers/helper.php';
?>