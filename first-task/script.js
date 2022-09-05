function addElements()
{
    var frag = document.createDocumentFragment();
    for (i = 0; i < 3; i++) {
            var div = document.createElement("div");
            div.className = "popup";
            div.style.backgroundColor = '#' + (Math.random().toString(16) + '000000').substring(2,8).toUpperCase();
            var p = document.createElement("p");
            p.innerText = "popup";
            div.append(p);
            frag.append(div);
        }
    document.body.append(frag);
}

addElements();

function addEvents()
{
    var elements = Array.from(document.getElementsByClassName("popup"));
    elements.forEach(element => {
        element.addEventListener("click", () => element.style.backgroundColor = '#' + (Math.random().toString(16) + '000000').substring(2,8).toUpperCase());
    });

    return elements;    
}

addEvents();

