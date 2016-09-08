<?php
class ControllerModulePvnmProfiler extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/pvnm_profiler');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		$this->load->model('localisation/language');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pvnm_profiler', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_loadings'] = $this->language->get('button_loadings');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_email'] = $this->language->get('tab_email');
		$data['tab_help'] = $this->language->get('tab_help');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_developer'] = $this->language->get('text_developer');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_slow'] = $this->language->get('text_slow');
		$data['text_email_url'] = $this->language->get('text_email_url');
		$data['text_email_date'] = $this->language->get('text_email_date');
		$data['text_email_time'] = $this->language->get('text_email_time');
		$data['text_email_queries'] = $this->language->get('text_email_queries');
		$data['text_seconds'] = $this->language->get('text_seconds');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_body_status'] = $this->language->get('entry_body_status');
		$data['entry_console_status'] = $this->language->get('entry_console_status');
		$data['entry_query_time'] = $this->language->get('entry_query_time');
		$data['entry_page_time'] = $this->language->get('entry_page_time');
		$data['entry_page_write'] = $this->language->get('entry_page_write');
		$data['entry_page_email'] = $this->language->get('entry_page_email');
		$data['entry_macros'] = $this->language->get('entry_macros');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_profiler', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['loadings'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_profiler', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pvnm_profiler_status'])) {
			$data['pvnm_profiler_status'] = $this->request->post['pvnm_profiler_status'];
		} else {
			$data['pvnm_profiler_status'] = $this->config->get('pvnm_profiler_status');
		}

		if (isset($this->request->post['pvnm_profiler_body_status'])) {
			$data['pvnm_profiler_body_status'] = $this->request->post['pvnm_profiler_body_status'];
		} else {
			$data['pvnm_profiler_body_status'] = $this->config->get('pvnm_profiler_body_status');
		}

		if (isset($this->request->post['pvnm_profiler_console_status'])) {
			$data['pvnm_profiler_console_status'] = $this->request->post['pvnm_profiler_console_status'];
		} else {
			$data['pvnm_profiler_console_status'] = $this->config->get('pvnm_profiler_console_status');
		}

		if (isset($this->request->post['pvnm_profiler_query_time'])) {
			$data['pvnm_profiler_query_time'] = $this->request->post['pvnm_profiler_query_time'];
		} else {
			$data['pvnm_profiler_query_time'] = $this->config->get('pvnm_profiler_query_time');
		}

		if (isset($this->request->post['pvnm_profiler_page_time'])) {
			$data['pvnm_profiler_page_time'] = $this->request->post['pvnm_profiler_page_time'];
		} else {
			$data['pvnm_profiler_page_time'] = $this->config->get('pvnm_profiler_page_time');
		}

		if (isset($this->request->post['pvnm_profiler_page_write'])) {
			$data['pvnm_profiler_page_write'] = $this->request->post['pvnm_profiler_page_write'];
		} else {
			$data['pvnm_profiler_page_write'] = $this->config->get('pvnm_profiler_page_write');
		}

		if (isset($this->request->post['pvnm_profiler_page_email'])) {
			$data['pvnm_profiler_page_email'] = $this->request->post['pvnm_profiler_page_email'];
		} else {
			$data['pvnm_profiler_page_email'] = $this->config->get('pvnm_profiler_page_email');
		}

		if (isset($this->request->post['pvnm_profiler_email_subject'])) {
			$data['pvnm_profiler_email_subject'] = $this->request->post['pvnm_profiler_email_subject'];
		} elseif ($this->config->get('pvnm_profiler_email_subject')) {
			$data['pvnm_profiler_email_subject'] = $this->config->get('pvnm_profiler_email_subject');
		} else {
			$data['pvnm_profiler_email_subject'] = array();
		}

		if (isset($this->request->post['pvnm_profiler_email_message'])) {
			$data['pvnm_profiler_email_message'] = $this->request->post['pvnm_profiler_email_message'];
		} elseif ($this->config->get('pvnm_profiler_email_message')) {
			$data['pvnm_profiler_email_message'] = $this->config->get('pvnm_profiler_email_message');
		} else {
			$data['pvnm_profiler_email_message'] = array();
		}

		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_profiler.tpl', $data));
	}

	public function loadings() {
		$this->load->language('module/pvnm_profiler');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/pvnm_profiler');

		if (isset($this->request->get['filter_url'])) {
			$filter_url = $this->request->get['filter_url'];
		} else {
			$filter_url = null;
		}

		if (isset($this->request->get['filter_time'])) {
			$filter_time = $this->request->get['filter_time'];
		} else {
			$filter_time = null;
		}

		if (isset($this->request->get['filter_date'])) {
			$filter_date = $this->request->get['filter_date'];
		} else {
			$filter_date = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'l.date';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
			
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_time'])) {
			$url .= '&filter_time=' . urlencode(html_entity_decode($this->request->get['filter_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . $this->request->get['filter_date'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_profiler', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_list'),
			'href' => $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['loadings'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_profiler', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/pvnm_profiler/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['pvnm_loadings'] = array();

		$filter_data = array(
			'filter_url'   => $filter_url,
			'filter_time'  => $filter_time,
			'filter_date'  => $filter_date,
			'sort'         => $sort,
			'order'        => $order,
			'start'        => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'        => $this->config->get('config_limit_admin')
		);

		$loadings_total = $this->model_module_pvnm_profiler->getLoadingsTotal($filter_data);

		$results = $this->model_module_pvnm_profiler->getLoadings($filter_data);
 
		foreach ($results as $result) {
			$data['pvnm_loadings'][] = array(
				'loading_id' => $result['loading_id'],
				'url'        => 'http://' . $result['url'],
				'time'       => $result['time'],
				'query'      => $result['query'],
				'slow'       => $result['slow'],
				'date'       => $result['date'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['loading_id'], $this->request->post['selected']),
				'href'       => $this->url->link('module/pvnm_profiler/queries', 'token=' . $this->session->data['token'] . '&loading_id=' . $result['loading_id'], 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_loadings'] = $this->language->get('button_loadings');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['column_url'] = $this->language->get('column_url');
		$data['column_time'] = $this->language->get('column_time');
		$data['column_query'] = $this->language->get('column_query');
		$data['column_slow'] = $this->language->get('column_slow');
		$data['column_date'] = $this->language->get('column_date');
		$data['text_list'] = $this->language->get('heading_title_list');
		$data['text_seconds'] = $this->language->get('text_seconds');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_time'] = $this->language->get('entry_time');
		$data['entry_date'] = $this->language->get('entry_date');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_time'])) {
			$url .= '&filter_time=' . urlencode(html_entity_decode($this->request->get['filter_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . $this->request->get['filter_date'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_url'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . '&sort=l.url' . $url, 'SSL');
		$data['sort_time'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . '&sort=l.time' . $url, 'SSL');
		$data['sort_query'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . '&sort=query' . $url, 'SSL');
		$data['sort_slow'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . '&sort=slow' . $url, 'SSL');
		$data['sort_date'] = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . '&sort=l.date' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_time'])) {
			$url .= '&filter_time=' . urlencode(html_entity_decode($this->request->get['filter_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . $this->request->get['filter_date'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $loadings_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($loadings_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($loadings_total - $this->config->get('config_limit_admin'))) ? $loadings_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $loadings_total, ceil($loadings_total / $this->config->get('config_limit_admin')));

		$data['filter_url'] = $filter_url;
		$data['filter_time'] = $filter_time;
		$data['filter_date'] = $filter_date;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['token'] = $this->session->data['token'];
		$data['slow_page'] = $this->config->get('pvnm_profiler_page_time');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_profiler_loadings.tpl', $data));
	}

	public function delete() { 
		$this->load->language('module/pvnm_profiler');

		$this->load->model('module/pvnm_profiler');

		if (isset($this->request->post['selected']) && $this->validate()) {
			foreach ($this->request->post['selected'] as $loading_id) {
				$this->model_module_pvnm_profiler->deleteLoading($loading_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/pvnm_profiler/loadings', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->loadings();
	}

	public function getQueries() {
		$this->load->language('module/pvnm_profiler');

		$this->load->model('module/pvnm_profiler');

		$json = array();

		$json['title'] = $this->language->get('text_queries');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$json['queries'] = array();

			$results = $this->model_module_pvnm_profiler->getQueries($this->request->post['loading_id']);

			$json['queries'] = '<pre style="font-size: 11px;">';

			foreach ($results as $result) {
				if ($result['time'] >= $this->config->get('pvnm_profiler_query_time')) {
					$json['queries'] .= '<span style="color: red !important;">' . $result['time'] . ' ' . $this->language->get('text_seconds') . ' - ' . $result['query'] . '</span><br>';
				} else {
					$json['queries'] .= '<span>' . $result['time'] . ' ' . $this->language->get('text_seconds') . ' - ' . $result['query'] . '</span><br>';
				}
			}

			$json['queries'] .= '</pre>';

			$json['success'] = $this->language->get('text_success');
		} else {
			$json['error'] = $this->error['warning'];
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/pvnm_profiler')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function install() {
		$this->load->model('module/pvnm_profiler');

		$this->model_module_pvnm_profiler->install();
	}

	public function uninstall() {
		$this->load->model('module/pvnm_profiler');

		$this->model_module_pvnm_profiler->uninstall();
	}
}