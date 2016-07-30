{{--
	You can include this multiple times in a custom add-or-edit view if necessary; break the
	$meta->cols() into multiple smaller arrays between each custom field!
--}}

@foreach ($cols as $colName => $col)
	<div class="row">
		<div class="columns small-12">
			@if (isset($errors))
				@foreach ($errors->get($colName) as $error)
					<div class="callout alert">
						{{ $error }}
					</div>
				@endforeach
			@endif
			<label>
				@if ($action == 'edit' && ! empty($col['logChanges']))
					<a href="{{ url('admin/changes/' . urlencode(get_class($model)) . '/' . $model->id . '/' . $colName) }}" class="fancybox" data-fancybox-type="iframe">
						<i class="fi-clock"></i>
					</a>
				@endif
				{{ $col['pretty'] }}
				@if ($col['type'] == 'text')
					{!! Form::text($colName, null, $col['attributes']) !!}
				@elseif ($col['type'] == 'wysiwyg')
					{!! Form::textarea($colName, null, $col['attributes'] + ['class' => 'ckeditor']) !!}
				@elseif ($col['type'] == 'select')
					{!! Form::select($colName, $col['options'], null, $col['attributes'] + ['class' => 'ckeditor']) !!}
				@elseif ($col['type'] == 'checkbox')
					{{-- Don't put in the hidden '0' field if the input is supposed to be disabled. --}}
					@if ( ! isset($col['attributes']['disabled']))
						{!! Form::hidden($colName, 0) !!}
					@endif
					{!! Form::checkbox($colName, 1, null, $col['attributes'] + ['class' => 'ckeditor']) !!}
				@elseif ($col['type'] == 'dateTime')
					{!! Form::text($colName, null, $col['attributes'] + ['class' => 'dateTime']) !!}
				@elseif ($col['type'] == 'date')
					{!! Form::text($colName, null, $col['attributes'] + ['class' => 'date']) !!}
				@elseif ($col['type'] == 'image')
					{!! Form::text($colName, null, $col['attributes']) !!}
				@endif
			</label>
		</div>
	</div>
@endforeach