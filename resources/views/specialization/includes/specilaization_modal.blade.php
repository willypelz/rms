{{--        modal display for specialization creation --}}
<div class="modal fade" id="specializationModal" tabindex="-1" role="dialog"
     aria-labelledby="specializationModalLabel"
     data-backdrop="static" data-keyboard="false"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="specializationModalLabel">Create Specialization</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="specialization_name"
                               id="specialization_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveSpecialization" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#saveSpecialization').click(function (e) {
        e.preventDefault();


        var specialization_name = $('#specialization_name').val();
        if (specialization_name == null || specialization_name == "") {
            $.growl.error({message: 'Please enter field name.'})
            return false;
        }

        var token = $('#token').val();
        var url = "{{ route('store-specialization') }}";


        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', name: specialization_name, background_callback: true
            },

            success: function (res) {
                const data = res.data;
                $('#specializationModal').modal('hide');
                $.growl.notice({title: "Success", message: 'Specialization successfully added'})
                let newOption = new Option(data.name, data.id, false, false);
                $('.select2').append(newOption).trigger('change');
                $(".select2-container option").remove();
                specialization_name = '';
            }
        });


    });
</script>
