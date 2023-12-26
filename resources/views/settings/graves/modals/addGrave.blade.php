<div class="modal" id="addGrave">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة قبر جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('graves.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="">إسم القبر بالعربية</label>
                            <input type="text" class="form-control" name="name_ar" id="name_ar" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">إسم القبر بالإنجليزية</label>
                            <input type="text" class="form-control" name="name_en" id="name_en" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="">المجمع</label>
                            <select name="block_id" class="form-control" id="">
                                <option value="" selected disabled>--حدد المجمع--</option>
                                @foreach ($blocks as $block)
                                    <option value="{{$block->id}}">{{ $block->name }}</option>
                                @endforeach
                            </select>
                        </div>
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