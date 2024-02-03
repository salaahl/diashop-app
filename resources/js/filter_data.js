document.getElementById("filter_select").addEventListener("change", () => {
    var myform = document.createElement("form");
    myform.action = "";
    myform.method = "post";
    
    filter = document.createElement("input");
    filter.value = document.getElementById("filter_select").value;
    filter.name = "filter";
    
    token = document.createElement("input");
    token.value = document.querySelector('[name="csrf-token"]').getAttribute("content");
    token.name = "_token";
    
    myform.appendChild(filter);
    myform.appendChild(token);
    
    document.body.appendChild(myform);
    myform.submit();
});