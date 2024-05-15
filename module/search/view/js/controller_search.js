//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function LoadCitySearch() {
    // console.log('Entro a LoadCitySearch');

    ajaxPromise(friendlyURL('?module=search&op=LoadCitySearch'), 'GET', 'JSON')//SearchCity
        .then(function (data) {

            // console.log(data);

            $('<option>Ciudad</option>').attr('selected', true).attr('disabled', true).appendTo('.search_selectCity');
            for (row in data) {
                $('<option value="' + data[row].ID_City + '">' + data[row].Ciudad + '</option>').appendTo('.search_selectCity');
            }
        }).catch(function () {
            //window.location.href = "index.php?modules=exception&op=503&error=fail_load_brands&type=503";
        });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function LoadOperationSearch(Ciudad) {

    // console.log('Entro a LoadOperationSearch');


    return new Promise(function(resolve, reject) {
        $('.search_selectOperation').empty();

        if (Ciudad == undefined || Ciudad === null) {
            ajaxPromise(friendlyURL('?module=search&op=LoadOperationSearch'), 'GET', 'JSON')//SearchOperationNull
                .then(function (data) {

                    // console.log("Datos de operación sin ciudad:", data);

                    $('<option>Operación</option>').attr('selected', true).attr('disabled', true).appendTo('.search_selectOperation');
                    for (row in data) {
                        $('<option value="' + data[row].ID_Operation + '">' + data[row].Operation + '</option>').appendTo('.search_selectOperation');
                    }

                    resolve(data); 
                }).catch(function () {
                    reject(); 
                });
        } else {
            $('.search_selectOperation').empty();
            ajaxPromise(friendlyURL('?module=search&op=LoadOperationSearch'), 'POST', 'JSON', {'Ciudad' : Ciudad})//SearchOperation
                .then(function (data) {

                    // console.log("Datos de operación con ciudad:", data);

                    $('<option>Operación</option>').attr('selected', true).attr('disabled', true).appendTo('.search_selectOperation');
                    for (row in data) {
                        $('<option value="' + data[row].ID_Operation + '">' + data[row].Operation + '</option>').appendTo('.search_selectOperation');
                    }

                    //console.log(data);

                    resolve(data); 
                }).catch(function () {
                    reject(); 
                });
        }
    });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function SearchCharger() {
    localStorage.removeItem('Ciudad');
    localStorage.removeItem('Operacion');
    LoadCitySearch();
    LoadOperationSearch();

    $(document).on('change', '.search_selectCity', function () {
        let Ciudad = $(this).val();

        if (Ciudad === undefined) {
            LoadOperationSearch();
        } else {
            LoadOperationSearch({ Ciudad });
        }
    });

    // $(document).on('change', '.search_selectOperation', function () {
    //     let selectedOperation = $(this).val();
    //     console.log("Operación seleccionada:", selectedOperation);
    // });
    
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function AutocompleteSearch() {
    // console.log("Estoy en AutocompleteSearch");

    // $("#autocom").on("keyup", function () {
    // });

    $("#autocom").keyup(function() {
            // console.log("keyup presionado");
     
             let sdata = { complete: $(this).val() };
     
             if ($('.search_selectCity').val() != undefined) {
                 sdata.Ciudad = $('.search_selectCity').val();
     
                 if ($('.search_selectOperation').val() != undefined) {
                     sdata.Operation = $('.search_selectOperation').val();
     
                 }
             } else if ($('.search_selectOperation').val() != undefined) {
                 sdata.Operation = $('.search_selectOperation').val();
                 
             }
             // console.log(sdata);
             ajaxPromise(friendlyURL('?module=search&op=AutocompleteSearch'), 'POST', 'JSON', { 'sdata': sdata })
             .then(function (data) {
         
                //  console.log(data);
         
                 $('#search_auto').empty();
                 $('#search_auto').fadeIn(1000);
                 for (row in data) {
     
                     $('<div></div>')
                         .addClass('autocomplete-item searchElement')
                         .attr('id', data[row].Type)
                         .text(data[row].Type)
                         .appendTo('#search_auto');
                 }
             }).catch(function () {
                 $('#search_auto').fadeOut(500);
             });
         
    });

    $(document).on("keyup", "#autocom", function() {
        // console.log("keyup presionado");
     
        let sdata = { complete: $(this).val() };

        if ($('.search_selectCity').val() != undefined) {
            sdata.Ciudad = $('.search_selectCity').val();

            if ($('.search_selectOperation').val() != undefined) {
                sdata.Operation = $('.search_selectOperation').val();

            }
        } else if ($('.search_selectOperation').val() != undefined) {
            sdata.Operation = $('.search_selectOperation').val();
            
        }
        // console.log(sdata);
        ajaxPromise(friendlyURL('?module=search&op=AutocompleteSearch'), 'POST', 'JSON', { 'sdata': sdata })
        .then(function (data) {
    
           //  console.log(data);
    
            $('#search_auto').empty();
            $('#search_auto').fadeIn(1000);
            for (row in data) {

                $('<div></div>')
                    .addClass('autocomplete-item searchElement')
                    .attr('id', data[row].Type)
                    .text(data[row].Type)
                    .appendTo('#search_auto');
            }
        }).catch(function () {
            $('#search_auto').fadeOut(500);
        });
    
    });

    $("#search-btn").on("click", function () {
        let searchQuery = $("#autocom").val();
        //console.log("Realizar búsqueda con:", searchQuery);
    });

    $(document).on('click', '.searchElement', function () {
        $('#autocom').val(this.getAttribute('id'));
        $('#search_auto').fadeOut(1000);
    });

    $(document).on('click scroll', function (event) {
        if (event.target.id !== 'autocom') {
            $('#search_auto').fadeOut(1000);
        }
    });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
function ButtonSearch() {
    $('#search-btn').on('click', function () {
        var search = [];

        //console.log($('.search_selectOperation').val());
        //console.log($('.search_selectCity').val());

        var selectedCity = $('.search_selectCity').val() || localStorage.getItem('Ciudad');
        var selectedOperation = $('.search_selectOperation').val() || localStorage.getItem('Operacion');

        localStorage.removeItem('Ciudad');
        localStorage.removeItem('Operacion');

        //console.log(selectedOperation);

        if (selectedCity !== null && selectedCity !== "0") {
            search.push({ "Ciudad": [selectedCity] });
            localStorage.setItem('Ciudad', selectedCity);
        } else {
            localStorage.removeItem('Ciudad');
        }

        if (selectedOperation !== null && selectedOperation !== "0") {
            search.push({ "Operacion": [selectedOperation] });
            localStorage.setItem('Operacion', selectedOperation);
        } else {
            localStorage.removeItem('Operacion');
        }

        var autocomValue = $('#autocom').val();

        //console.log(autocomValue);

        if (autocomValue !== null && autocomValue.trim() !== '') {
                search.push({"complete" : [autocomValue]})
        }

        //console.log(search);

        if (search.length !== 0) {
            //localStorage.removeItem('Filters_Search');
            localStorage.setItem('Filters_Search', JSON.stringify(search));
            ////
            // console.log(localStorage.getItem('Filters_Search'));
        }

    //console.log(localStorage.getItem('Filters_Search'));      

    var FiltersSearch = JSON.parse(localStorage.getItem('Filters_Search') || '[]');
    localStorage.setItem('FiltersShop', JSON.stringify(FiltersSearch));    

    window.location.href = 'index.php?module=shop';
    });
}
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//

/*function SearchFunctions() {

    $("#autocom").on("keyup", function () {
        let sdata = { complete: $(this).val() };

        if ($('.search_selectCity').val() != undefined) {
            sdata.Ciudad = $('.search_selectCity').val();

            if ($('.search_selectOperation').val() != undefined) {
                sdata.Operation = $('.search_selectOperation').val();
            }
        } else if ($('.search_selectOperation').val() != undefined) {
            sdata.Operation = $('.search_selectOperation').val();
        }

        ajaxPromise('Module/Search/ControladorSearch/ControllerSearch.php?Option=AutocompleteSearch', 'POST', 'JSON', { 'sdata': sdata })
            .then(function (data) {
                $('#search_auto').empty();
                $('#search_auto').fadeIn(1000);
                for (row in data) {
                    $('<div></div>')
                        .addClass('autocomplete-item searchElement')
                        .attr('id', data[row].Type)
                        .text(data[row].Type)
                        .appendTo('#search_auto');
                }
            }).catch(function () {
                $('#search_auto').fadeOut(500);
            });
    });

    $("#search-btn").on("click", function () {
        var search = [];

        var selectedCity = $('.search_selectCity').val() || localStorage.getItem('Ciudad');
        var selectedOperation = $('.search_selectOperation').val() || localStorage.getItem('Operacion');

        localStorage.removeItem('Ciudad');
        localStorage.removeItem('Operacion');

        if (selectedCity !== null && selectedCity !== "0") {
            search.push({ "Ciudad": [selectedCity] });
            localStorage.setItem('Ciudad', selectedCity);
        } else {
            localStorage.removeItem('Ciudad');
        }

        if (selectedOperation !== null && selectedOperation !== "0") {
            search.push({ "Operacion": [selectedOperation] });
            localStorage.setItem('Operacion', selectedOperation);
        } else {
            localStorage.removeItem('Operacion');
        }

        var autocomValue = $('#autocom').val();
        if (autocomValue !== null && autocomValue.trim() !== '') {
            if (selectedCity !== null && selectedCity !== "0") {
                search.push({ "Ciudad": [autocomValue] });
            } else {
                search.push({ "Operation": [autocomValue] });
            }
        }

        if (search.length !== 0) {
            localStorage.setItem('Filters_Search', JSON.stringify(search));
        }

        var FiltersSearch = JSON.parse(localStorage.getItem('Filters_Search') || '[]');
        localStorage.setItem('FiltersShop', JSON.stringify(FiltersSearch));    

        var dataFromLocalStorage = JSON.parse(localStorage.getItem('FiltersShop') || '[]');

        dataFromLocalStorage.forEach(function(filter) {
            for (var key in filter) {
                if (key === 'ch.ID_City') {
                    localStorage.setItem('FiltersShop_City', filter[key][0]);
                } else if (key === 'oh.ID_Operation') {
                    localStorage.setItem('FiltersShop_Operation', filter[key][0]);
                }
            }
        });

        window.location.href = 'index.php?page=Shop';
    });

    $(document).on('click', '.searchElement', function () {
        $('#autocom').val(this.getAttribute('id'));
        $('#search_auto').fadeOut(1000);
    });

    $(document).on('click scroll', function (event) {
        if (event.target.id !== 'autocom') {
            $('#search_auto').fadeOut(1000);
        }
    });
}*/

//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//
//#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·#·//


$(document).ready(function () {

    SearchCharger();
    AutocompleteSearch();
    ButtonSearch();

    //no toca
    // SearchFunctions();
});