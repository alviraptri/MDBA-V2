//Wizard Init

$("#wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    titleTemplate: '#title#'
});

//Form control

$('#tglDnAdmin').on('change', function(e) {
    // $('#enteredFirstName').text(e.target.value || 'Cha');
    $('input[name=dnTgl]').val(e.target.value);
});

$('#noDn').on('change', function(e) {
    // $('#enteredLastName').text(e.target.value || 'Ji-Hun C');
    $('input[name=dnNo]').val(e.target.value);
});

$('#noCo').on('change', function(e) {
    // $('#enteredPhoneNumber').text(e.target.value || '+230-582-6609');
    $('input[name=coNo]').val(e.target.value);
});

$('#noGr').on('change', function(e) {
    // $('#enteredEmailAddress').text(e.target.value || 'willms_abby@gmail.com');
    $('input[name=grNo]').val(e.target.value);
});

$('#noPo').on('change', function(e) {
    // $('#enteredDesignation').text(e.target.value || 'Junior Developer');
    $('input[name=poNo]').val(e.target.value);
});

$('#transporterAdm').on('change', function(e) {
    // $('#enteredDepartment').text(e.target.value || 'UI Development');
    $('input[name=transporter]').val(e.target.value);
});

$('#pabrikWindowAdm').on('change', function(e) {
    // $('#enteredEmployeeNumber').text(e.target.value || 'JDUI36849');
    $('input[name=supplier]').val(e.target.value);
});

$('#nopolAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=kendaraan]').val(e.target.value);
});

$('#driverAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=pengemudi]').val(e.target.value);
});

$('#returnIsiAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=smrAdmReturn]').val(e.target.value);
});

$('#jugrackAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=smrAdmJugrack]').val(e.target.value);
});

$('#glnKosongAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=smrAdmGalKos]').val(e.target.value);
});

$('#paletAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=smrAdmPalet]').val(e.target.value);
});

$('#qtyGrAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=smrAdmGr]').val(e.target.value);
});

$('#qtyDnAdm').on('change', function(e) {
    // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
    $('input[name=varianQty]').val(e.target.value);
});

