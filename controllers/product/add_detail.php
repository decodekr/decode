<?php
if($param['has_data']=='next_category'){
    $nextCategories=getList('product_categories','category_group="'.str_replace('&quot;','"',$param['category_group']).'" AND product_type="'.$param['type'].'"','','','no asc');
    echo json_encode($nextCategories);
    exit;
}
if($param['has_data']=='1'){
    $total=getTotal('product_lists','create_date like "%'.date('Y-m-d').'%"')+1;
    $param['product_id']=date('Ymd').str_pad($total,4,'0',STR_PAD_LEFT);
    $param['category']=$param['product_type'];


    $param['details']= jsonEncode($param);
    $param['user_no'] = $session['login'];
    insertItem('product_lists',$param);
    printMessage('매물이 등록되었습니다.','/product/add_detail#confirm');
    exit;
}

include'views/header.html';
?>
<?php
if(!$session['login']){
    ?>
    <script>

        Swal.fire({
            title: '',
            text: '로그인 후 이용해주세요.',
            icon: 'error',

            onAfterClose:function(){
                location.href='/user/login'
            },
            confirmButtonText: '확인'
        });



    </script>
    <?php
}
?>
    <form method="post" action="">
        <input type="hidden" name="has_data" value="1">
        <main class="site-main site-login">
            <div class="box-center box-center-2">

                <div class="row row-filter reg-filter">
                    <div class="filter-options">
                        <div class="block-content">
                            <div class="filter-options-item filter-categori categories">
                                <div class="filter-options-title">품목</div>
                                <div class="filter-options-content">
                                    <ul >
                                        <li><label class="inline"><input type="checkbox" name="product_type" value="pipe" data-next="seamless/welded" data-type="pipe"><span class="input"></span> Pipe
                                            </label></li>
                                        <li><label class="inline"><input type="checkbox" name="product_type" value="valve" data-next="valve" data-type="valve"><span class="input"></span> Valve
                                            </label></li>
                                        <li><label class="inline"><input type="checkbox"  name="product_type" value="fitting" data-next="fitting" data-type="fitting"><span class="input"></span> Fitting
                                            </label></li>
                                        <li><label class="inline"><input type="checkbox"  name="product_type" value="flange" data-next="type_for_flange" data-type="flange"><span class="input"></span> Flange
                                            </label></li>

                                    </ul>
                                </div>
                            </div>

                            <script>
                                $(document).on('click','form input',function(){
                                    $(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
                                });
                                $(document).on('click','.categories li input',function(){
                                    var categoryGroup =  $(this).data('next');
                                    var type= $(this).data('type');
                                    var $this = $(this);
                                    var step=1;
                                    var $parent = $this.parent().parent().parent().parent().parent();
                                    var $check= $(this).prop('checked');

                                    $parent.nextAll('.categories').remove();


                                    if($check&&categoryGroup!=''){
                                        //	alert('마지막 카테고리입니다.');


                                        //if($(this).parent().find('ul').size()==0){
                                        $(this).parent().siblings().hide();
                                        postRequest({
                                            url : '',
                                            data : {category_group:categoryGroup,has_data : 'next_category',type:type},
                                            success : function($data){
                                                var  $template=  [];
                                                for(var iu=0;iu<$data.list.length;iu++){
                                                    if($data.list[iu].additional_info==''){
                                                        additional = ''
                                                    }
                                                    else{
                                                        additional = '('+$data.list[iu].additional_info+')'
                                                    }
                                                    $template.push('<li><label class="inline"><input type="checkbox" name="'+$data.list[iu].category_group+'" value="'+$data.list[iu].name+additional+'" data-next="'+$data.list[iu].next_category_group+'" data-type="'+$data.list[iu].product_type+'"><span class="input"></span>'+$data.list[iu].name+additional+' </label></li>');
                                                }
                                                $parent.after(' <div class="filter-options-item filter-categori categories"><div class="filter-options-title">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+'</div><div class="filter-options-content"><ul >'+$template.join('')+'</ul></div></div>')


                                            }


                                        });
                                    }
                                    else{
                                        $(this).parent().find('ul').remove();
                                        $(this).parent().siblings().fadeIn();

                                    }

                                });

                            </script>

                            <!-- <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">길이</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text">
                                    </div>
                                </div>
                            </div> -->




                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">Scratch</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <label class="inline"><input type="radio" name="scratch_y/n" value="pipe" ><span class="input"></span> YES
                                        </label>
                                        <label class="inline"><input type="radio" name="scratch_y/n" value="pipe" ><span class="input"></span> NO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">Dent</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <label class="inline"><input type="radio" name="dent_y/n" value="pipe" ><span class="input"></span> YES
                                        </label>
                                        <label class="inline"><input type="radio" name="dent_y/n" value="pipe" ><span class="input"></span> NO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">Rust</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <label class="inline"><input type="radio" name="rust_y/n" value="pipe"  data-type="pipe"><span class="input"></span> YES
                                        </label>
                                        <label class="inline"><input type="radio" name="rust_y/n" value="pipe" ><span class="input"></span> NO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">Certi</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <label class="inline"><input type="radio" name="product_type" value="pipe" ><span class="input"></span> YES
                                        </label>
                                        <label class="inline"><input type="radio" name="product_type" value="pipe" ><span class="input"></span> NO
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">제조 날짜</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text" name="manufactured_year" class="datepicker" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">제조사</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text" name="manufacturer" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">제조 국가</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text" name="country" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">가격</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text" name="price" value="0"> &#8361;
                                    </div>
                                </div>
                            </div>
                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">재고</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text" name="amount" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">통화</div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                       <select name="currency" class="form-select" style="padding:10px;">
											<option value="krw">KRW</option>
											<option value="usd">USD</option>

                                       </select>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-options-item filter-categori">
                                <div class="filter-options-title">운송가능일정
                                </div>
                                <div class="filter-options-content">
                                    <div class="filter-date">
                                        <input type="text" name="delivery_date" value="5">  일 이내
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <p class="form-row reg-form-row">
                        <input type="submit" value="매물 등록" name="Submit" class="button-submit">
                        <button type="button" class="button-join" id="add_cancel_button" style="background-color: #9A0000;">취소</button>
                        <button type="button" class="button-join" id="my_product_button" style="margin-left: 30px;">내 매물</button>
                    </p>

                </div>
        </main>
    </form>


    <style>
        #uploaded_image{
            display: none;
            width: 200px;

        }
        .button-add-image{
            position: relative;
            overflow: hidden;
        }
        .button-add-image iframe{
            position: absolute;
            top: 0;
            left: 0;
            opacity:0;
        }

    </style>
    <script>
        function upload_image($image){
            $('#uploaded_image_path').val($image.path);
            $('#uploaded_image').attr({src: '/files/'+$image.path}).css({display:'block'});
        }


        $('#my_product_button').click(function () {

            location.href = "/seller/product";

            return false;

        });

        $('#add_cancel_button').click(function () {

            location.href = "/";

            return false;

        });

    </script>



<?php
include'views/footer.html';
?>