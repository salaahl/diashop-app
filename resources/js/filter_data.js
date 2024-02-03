document.getElementById("filter_select").addEventListener("change", () => {
    let myform = document.createElement("form");
    myform.action = "";
    myform.method = "post";
    
    let filter = document.createElement("input");
    filter.value = document.getElementById("filter_select").value;
    filter.name = "filter";
    
    let token = document.createElement("input");
    token.value = document.querySelector('[name="csrf-token"]').getAttribute("content");
    token.name = "_token";
    
    myform.appendChild(filter);
    myform.appendChild(token);
    
    document.body.appendChild(myform);
    myform.submit();
});
