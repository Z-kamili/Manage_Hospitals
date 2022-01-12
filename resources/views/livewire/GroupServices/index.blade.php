<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">{{trans('Dashboard/Services.Services')}}</button><br><br>
<div class="table-responsive">
        <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
            <tr>
                <th>#</th>
                <th>{{trans('Dashboard/Services.name')}}</th>
                <th>{{trans('Dashboard/Services.price_input')}}</th>
                <th>{{trans('Dashboard/Services.description')}}</th>
                <th>{{trans('Dashboard/Services.Process')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                    <td>{{ $group->notes }}</td>
                    <td>
                        <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

                        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $group->id }})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
    </table>
</div>