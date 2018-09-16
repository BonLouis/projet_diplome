import axios from 'axios';

const processDatas = form => {
	const data = {};
	const inputs = [...form.querySelectorAll('[name]')]
		.filter(x => {
			// If it's a radio,
			// I only want checked ones
			if (x.type === 'radio')
				return !!x.checked;
			// If it's not,
			// I dont want those which begin by "_" (Laravel's ones)
			else
				return /^[^_]/.test(x.name) && !!x.value
		});

	for (const el of inputs)
		data[el.name] = el.value;

	return data;
}

const d = document;

const form = d.querySelector('#form-to-send');

const token = form.querySelector('input[name="_token"]').value;

const hasInnerMethod = !!form.querySelector('input[name="_method"]');

const method = hasInnerMethod ? form.querySelector('input[name="_method"]').value : form.method;


/**
 * Listener
 * 	  &
 * Handler
 */
console.log(processDatas(form));
form.addEventListener('submit', e => {
	console.log(e);
	e.preventDefault();
	axios({
		url: form.action,
		method,
		contentType : 'application/json',
		headers: {
			'X-CSRF-TOKEN': token,
			'X-REQUESTED-WITH': 'XMLHttpRequest',
			'Accept': 'application/json'
		},
		data: processDatas(e.target),
	}).then((a) => {
		console.log('(ah)');
	}).catch((data) => {
		console.log(data.response);
	})
});
