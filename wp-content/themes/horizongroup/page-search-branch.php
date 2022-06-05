<?php
get_header();

?>
<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/university.jpg' ?>);">
        <div class="container" style="text-align: right" dir="rtl">
            <h2>ابحث عن تخصصك</h2>
        </div>
    </div>
</div>
<div class="container pt-100 pb-130" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <select id="searchBranch">
                <option value="-1">ابحث عن تخصصك</option>
            </select>
        </div>
    </div>
</div>

<div style="width:100%;height:100px"></div>


<div class="result_wrapper">
    
</div>

<?php
get_footer();
