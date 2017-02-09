function addNewResult(elem) {
    var test = parseInt(elem.getAttribute("tests"));
    var numberOfResults = parseInt(elem.getAttribute("count-results"));
    console.log("elem\t", elem);
    console.log("numberOfResults\t" + numberOfResults);
    console.log("tests\t" + test);
    elem.innerHTML = elem.innerHTML + ' <div class="row"> <div class="col-lg-2"> <label> Result Title : <input name="tests[' + test + '][results][' + numberOfResults + '][title]" value=""> </label> </div> <div class="col-lg-6 text-center"> </div> <label class="col-lg-2"> Result Value : <input name="tests[' + test + '][results][' + numberOfResults + '][value]" value=""> </label> </div> ';
    numberOfResults++;
    elem.setAttribute("count-results", "" + numberOfResults);
}
function addNewTest(elem) {
    var numberOfTests = parseInt(elem.getAttribute("count-tests"));
    elem.innerHTML = elem.innerHTML + ' <div> <hr> <div class="row"> <div class="col-lg-2"> <label> Title : <input name="tests[' + numberOfTests + '][title]" value=""> </label> </div> <div class="col-lg-6 text-center"> Test Form </div> <label class="col-lg-2"> Description : <input name="tests[' + numberOfTests + '][desc]" value=""> </label> </div> <div class="results" count-results="1" tests="' + numberOfTests + '"> <div class="row"> <div class="col-lg-2"> <label> Result Title : <input name="tests[' + numberOfTests + '][results][0][title]" value=""> </label> </div> <div class="col-lg-6 text-center"> </div> <label class="col-lg-2"> Result Value : <input name="tests[' + numberOfTests + '][results][0][value]" value=""> </label> </div> </div> <button class="btn btn-success" type="button" onclick="addNewResult(this.parentElement.getElementsByClassName(\'results\')[0]);"> add new result </button> </div> ';
    numberOfTests++;
    elem.setAttribute("count-tests", "" + numberOfTests);
}

var $patient = $("#patient");
$patient.typeahead({
    source: [{id: "someId1", name: "Display name 1"},
        {id: "someId2", name: "Display name 2"}],
    autoSelect: true
});

$patient.on("input", function () {
    console.log("IAMHERE");
    $patient.typeahead({
        source: [{id: "someId1", name: "Reza"},
            {id: "someId2", name: "Fouadi"}]
    })
});
$patient.change(function () {
    var current = $patient.typeahead("getActive");
    if (current) {
        // Some item from your model is active!
        if (current.name == $patient.val()) {
            // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
        } else {
            // This means it is only a partial match, you can either add a new item
            // or take the active if you don't want new items
        }
    } else {
        // Nothing is active so it is a new value (or maybe empty value)
    }
});


var patientEmails = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: $('.typeahead').attr("url") + "/"+'%QUERY',
        wildcard: '%QUERY'
    }
});

$('.typeahead').typeahead(null, {
    name: 'best-pictures',
    display: 'email',
    source: patientEmails
});
