<div class="modal" id="editBlock{{$block->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل المجمع</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('blocks.update', $block->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">إسم المقبرة بالعربية</label>
                            <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$block->getTranslation('name', 'ar')}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">إسم المقبرة بالإنجليزية</label>
                            <input type="text" class="form-control" name="name_en" id="name_en" value="{{$block->getTranslation('name', 'en')}}"  required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="">المقبرة</label>
                            <select name="cemetery" class="form-control" id="">
                                <option value="" selected disabled>--حدد المقبرة--</option>
                                @foreach ($cemeteries as $cemetery)
                                    <option value="{{$cemetery->id}}" {{$block->cemetery_id == $cemetery->id ? 'selected' : ''}}>{{ $cemetery->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="map-container" style="margin: 2px;">
                        <div class="row map-input-fields">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-md map-input-with-no-padding">
                                        <label for=""> خط العرض</label>
                                        <input class="form-control" readonly name="latitude" value="{{$block->latitude}}" type="text"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-md map-input-with-no-padding">
                                        <label for="">خط الطول</label>
                                        <input class="form-control" readonly  name="longitude" value="{{$block->Longitude}}" type="text"><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">حفظ البيانات</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>