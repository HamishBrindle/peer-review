import _ from 'lodash';
import '../scss/main.scss';

function component() {
    var element = document.createElement('div');

    // Lodash, currently included via a script, is required for this line to work
    element.innerHTML = _.join(['Hello', 'webpack'], ' ');

    return element;
}

document.body.appendChild(component());

/* Building the modal
 ----------------------------------------------------------------------------*/
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// When the user clicks on the button, open the modal
window.onload = function() {
    modal.style.display = "block";
}
