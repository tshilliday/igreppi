// components/inputs/index

function Inputs() {
    var inputs = document.querySelectorAll(".ginput_container");

    for (var i = 0; i < inputs.length; i++) {
        var focus = document.createElement("div");
        focus.classList.add("input-focus");
        inputs[i].appendChild(focus);
    }
}

export default Inputs;
