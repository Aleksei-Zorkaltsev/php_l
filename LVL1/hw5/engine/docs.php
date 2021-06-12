<?php
function getDocs() {
    return  array_splice(scandir('docs/'), 2);
}