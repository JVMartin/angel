{{--
	You can include this multiple times in a custom add-or-edit view if necessary; break the
	$meta->cols() into multiple smaller arrays between each custom field!  (Ya feel?)
--}}

@foreach ($cols as $colName => $col)
	@php
		$col['attributes']['id'] = "input-$colName";
		$class = ($errors->has($colName)) ? ' is-invalid-input' : '';
		$classArr = ($errors->has($colName)) ? ['class' => 'is-invalid-input'] : [];
		$default = ( ! isset($model) && isset($col['default'])) ? $col['default'] : null;
	@endphp
	<div class="row">
		<div class="columns small-12">
			<label for="input-{{ $colName }}" class="{{
				(($col['type'] == 'wysiwyg') ? 'wysiwyg-label' : '') .
				(($errors->has($colName)) ? ' is-invalid-label' : '') }}">
				@if ($action == 'edit' && ! empty($col['logChanges']))
					<a
						role="button"
						data-open="changesModal"
						class="openChangesButton"
						data-url="{{ url('admin/changes/' . urlencode(get_class($repository)) . '/' . $model->hash . '/' . $colName) }}"
					>
						<i class="fa fa-clock-o"></i>
					</a>
				@endif
				{{ $col['pretty'] }}
				@if ($col['type'] == 'text')
					{!! Form::text($colName, $default, $col['attributes'] + $classArr + ['placeholder' => $col['pretty']]) !!}
				@elseif ($col['type'] == 'image')
					<div class="input-group">
						{!! Form::text($colName, $default, $col['attributes'] + [
							'class' => 'input-group-field' . $class,
							'placeholder' => $col['pretty']
						]) !!}
						<div class="input-group-button">
							<button type="button" data-input="input-{{ $colName }}" data-preview="preview-{{ $colName }}" class="lfm-image button">
								<i class="fa fa-picture-o"></i> Choose
							</button>
						</div>
					</div>
					<img id="preview-{{ $colName }}" class="img-preview" src="{{ isset($model) ? $model->$colName : '' }}">
				@elseif ($col['type'] == 'textarea')
					{!! Form::textarea($colName, $default, $col['attributes'] + $classArr) !!}
				@elseif ($col['type'] == 'wysiwyg')
					{!! Form::textarea($colName, $default, $col['attributes'] + ['class' => 'tinymce' . $class]) !!}
				@elseif ($col['type'] == 'select')
					{!! Form::select($colName, $col['options'], $default, $col['attributes'] + $classArr) !!}
				@elseif ($col['type'] == 'checkbox')
					{{-- Don't put in the hidden '0' field if the input is supposed to be disabled. --}}
					@if ( ! isset($col['attributes']['disabled']))
						{!! Form::hidden($colName, 0) !!}
					@endif
					@if (isset($model))
						{{-- WTF?!  Glitch in form builder, model binding not working. --}}
						{!! Form::checkbox($colName, 1, old($colName, $model->$colName), $col['attributes'] + $classArr) !!}
					@else
						{!! Form::checkbox($colName, 1, $default, $col['attributes'] + $classArr) !!}
					@endif
				@elseif ($col['type'] == 'dateTime')
					{!! Form::text($colName, $default, $col['attributes'] + ['class' => 'dateTime' . $class]) !!}
				@elseif ($col['type'] == 'date')
					{!! Form::text($colName, $default, $col['attributes'] + ['class' => 'date' . $class]) !!}
				@elseif ($col['type'] == 'view')
					@if (isset($model))
						<div class="callout">
							{!! nl2br($model->$colName) !!}
						</div>
					@endif
				@elseif ($col['type'] == 'tags')
					@if (isset($model))
						@php
							$old = old($colName, $model->tags->implode('name', ','));
						@endphp
					@else
						@php($old = old($colName))
					@endif
					<input type="text" class="tags" name="{!! $colName !!}" value="{!! $old !!}">
				@endif

				{{-- Show all the validation errors for this input. --}}
				@foreach ($errors->get($colName) as $error)
	        <span class="form-error is-visible">
		        {!! $error !!}
	        </span>
	      @endforeach
			</label>
		</div>
	</div>
@endforeach
