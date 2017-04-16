<?php

function prerender($item) {
    return '<span style="color:green">' . htmlentities($item) . '</span>';
}