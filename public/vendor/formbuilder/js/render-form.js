jQuery(function() {
	var fbRenderOptions = {
		container: false,
		dataType: 'json',
		formData: window._form_builder_content ? window._form_builder_content : '',
		render: true,
		disableFields: [
            'button',
            'header',
            'paragraph',
            'textarea',
            'select',
            'number',
            'date',
            'autocomplete',
            'file',
            'checkbox-group',
            'radio-group',
            'hidden',
            // buttons are not needed since we are the one handling the submission
        ],  // field types that should not be shown
        disabledAttrs: [
            // 'access',
            'access',
            'description',
            'inline',
            'label',
            'max',
            'maxlength',
            'min',
            'multiple',
            'name',
            'options',
            'other',
            'placeholder',
            'required',
            'rows',
            'step',
            'subtype',
            'toggle',
            'value'
        ],
	}

	$('#fb-render').formRender(fbRenderOptions)
})
