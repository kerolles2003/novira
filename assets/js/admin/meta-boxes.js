/**
 * Novira Academy - Admin Meta Box Enhancements
 *
 * Handles repeater add/remove for department and service meta boxes.
 * Labels are localized from PHP via noviraMetaBoxLabels.
 */

document.addEventListener('DOMContentLoaded', function () {

	var L = window.noviraMetaBoxLabels || {};

	var fieldConfig = {
		programs: {
			containerId: 'programs-container',
			postName: 'education_programs',
			fields: [
				{ name: 'title', label: L.program_name, type: 'input' },
				{ name: 'description', label: L.program_desc, type: 'textarea' },
				{ name: 'duration', label: L.program_duration, type: 'input' },
				{ name: 'requirements', label: L.program_reqs, type: 'textarea' },
			],
		},
		courses: {
			containerId: 'courses-container',
			postName: 'education_courses',
			fields: [
				{ name: 'title', label: L.course_name, type: 'input' },
				{ name: 'description', label: L.program_desc, type: 'textarea' },
				{ name: 'schedule', label: L.course_schedule, type: 'input' },
			],
		},
		services: {
			containerId: 'services-container',
			postName: 'translation_services',
			fields: [
				{ name: 'type', label: L.service_type, type: 'input' },
				{ name: 'description', label: L.program_desc, type: 'textarea' },
				{ name: 'turnaround', label: L.service_turnaround, type: 'input' },
			],
		},
		pricing: {
			containerId: 'pricing-container',
			postName: 'translation_pricing',
			fields: [
				{ name: 'service', label: L.pricing_service, type: 'input' },
				{ name: 'price', label: L.pricing_price, type: 'input' },
				{ name: 'includes', label: L.pricing_includes, type: 'textarea' },
			],
		},
		curriculum: {
			containerId: 'curriculum-container',
			postName: 'diploma_curriculum',
			fields: [
				{ name: 'subject', label: L.curriculum_subject, type: 'input' },
				{ name: 'grades', label: L.curriculum_grades, type: 'input' },
				{ name: 'hours', label: L.curriculum_hours, type: 'input' },
				{ name: 'description', label: L.program_desc, type: 'textarea' },
			],
		},
	};

	// Add item
	document.querySelectorAll('.novira-add-item').forEach(function (button) {
		button.addEventListener('click', function () {
			var group = this.getAttribute('data-group');
			var config = fieldConfig[group];
			if (!config) return;

			var container = document.getElementById(config.containerId);
			if (!container) return;

			var index = container.querySelectorAll('.novira-repeater-item').length;
			var div = document.createElement('div');
			div.className = 'novira-repeater-item';

			config.fields.forEach(function (f) {
				var label = document.createElement('label');
				label.textContent = f.label || f.name;
				div.appendChild(label);

				var el;
				if (f.type === 'textarea') {
					el = document.createElement('textarea');
					el.rows = 3;
				} else {
					el = document.createElement('input');
					el.type = 'text';
				}
				el.name = config.postName + '[' + index + '][' + f.name + ']';
				div.appendChild(el);
			});

			var removeBtn = document.createElement('button');
			removeBtn.type = 'button';
			removeBtn.className = 'button button-secondary novira-remove-item';
			removeBtn.textContent = L.remove || 'Remove';
			div.appendChild(removeBtn);

			container.appendChild(div);
		});
	});

	// Remove item
	document.addEventListener('click', function (e) {
		if (e.target.classList.contains('novira-remove-item')) {
			e.target.closest('.novira-repeater-item').remove();
		}
	});

});
