<?php

function makeNode($regexString, $action, $overRidingAction = false) {
    $node = array(
        'regexString' => $regexString,
        'action' => $action,
        'overRidingAction' => $overRidingAction
    );
    return $node;
}

function writeToRoutingFile($nodeString) {
    file_put_contents(__dir__.'/RoutingNodes.json', $nodeString);
}
