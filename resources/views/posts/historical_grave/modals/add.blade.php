<!-- Large Modal -->
<div class="modal" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة قبر تاريخي</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('historical_grave.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md">
                            <label for="title">إسم صاحب القبر التاريخي</label>
                            <input type="text" name="title" placeholder="إسم صاحب القبر التاريخي" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="location">العنوان</label>
                            <input name="location" placeholder="عنوان القبر" class="form-control" type="text"  required>
                            </input>
                        </div>
                    </div>
                    <br>
                    <div class="map-container" style="margin: 2px;">
                    <div class="row map-input-fields">
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label for="sub_title"> العنوان الفرعي</label>
                                    <input class="form-control"  name="sub_title" type="text"><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group row">
                                <div class="col-md map-input-with-no-padding">
                                    <label for="text"> نبذة عن صاحب الفبر</label>
                                    <input class="form-control" name="text" type="text"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-info" type="submit"><i class="fa fa-plus"></i> إضافة</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--End Large Modal -->