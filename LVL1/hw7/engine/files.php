<?php
function getFiles() {
    return  array_splice(scandir('docs/'), 2);
}