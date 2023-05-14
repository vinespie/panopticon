<?php
defined('AKEEBA') || die;

/**
 * @var \Akeeba\Panopticon\View\Main\Html $this
 */
?>

@include('Main/heartbeat')

<div class="card">
    <h3 class="card-header bg-secondary-subtle d-flex flex-column align-items-center flex-sm-row gap-2 fs-5">
        <span class="flex-grow-1">
            <span class="fa fa-globe pe-2" aria-hidden="true"></span>
            @lang('PANOPTICON_MAIN_SITES_LBL_MY_SITES_HEAD')
        </span>
        <span>
            <a href="@route('index.php?view=sites')"
               class="btn btn-outline-dark btn-sm">
                <span class="fa fa-gears" aria-hidden="true"></span>
                @lang('PANOPTICON_MAIN_SITES_LBL_MY_SITES_MANAGE')
            </a>
        </span>
    </h3>
    <div class="card-body">
        <form name="sitesForm" id="adminForm" method="post"
              action="@route('index.php?view=main')">
            <table class="table table-striped table-hover table-sm align-middle table-responsive-sm">
                <caption class="visually-hidden">
                    @lang('PANOPTICON_MAIN_SITES_TABLE_CAPTION')
                </caption>
                <thead class="table-dark">
                <tr>
                    <th>@lang('PANOPTICON_MAIN_SITES_THEAD_SITE')</th>
                    <th>
                        <span class="fab fa-joomla fs-3" aria-hidden="true"
                              data-bs-toggle="tooltip" data-bs-placement="bottom"
                              data-bs-title="@lang('PANOPTICON_MAIN_SITES_THEAD_JOOMLA')"
                        ></span>
                        <span class="visually-hidden">
                        @lang('PANOPTICON_MAIN_SITES_THEAD_JOOMLA')
                        </span>
                    </th>
                    <th>
                        <span class="fa fa-cubes fs-3" aria-hidden="true"
                              data-bs-toggle="tooltip" data-bs-placement="bottom"
                              data-bs-title="@lang('PANOPTICON_MAIN_SITES_THEAD_EXTENSIONS')"
                        ></span>
                        <span class="visually-hidden">
                        @lang('PANOPTICON_MAIN_SITES_THEAD_EXTENSIONS')
                        </span>
                    </th>
                    <th>
                        <span class="fab fa-php fs-3" aria-hidden="true"
                              data-bs-toggle="tooltip" data-bs-placement="bottom"
                              data-bs-title="@lang('PHP version')"
                        ></span>
                        <span class="visually-hidden">
                        @lang('PHP version')
                        </span>
                    </th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php
                /** @var \Akeeba\Panopticon\Model\Site $item */
                ?>
                @foreach($this->items as $item)
                    <?php
                    $url    = substr($item->url, 0, strrpos($item->url, '/api'));
                    $config = new Awf\Registry\Registry($item->config);
                    ?>
                    <tr>
                        <td>
                            <div class="fw-medium">
                                {{ $item->name }}
                            </div>
                            <div class="small mt-1">
                                <span class="visually-hidden">@lang('PANOPTICON_MAIN_SITES_LBL_URL_SCREENREADER')</span>
                                <a href="{{{ $url }}}" class="link-secondary text-decoration-none" target="_blank">
                                    {{{ $url }}}
                                    <span class="fa fa-external-link-square"></span>
                                </a>
                            </div>
                        </td>
                        <td>
                            @include('Main/site_joomla', [
                                'item' => $item,
                                'config' => $config,
                            ])
                        </td>
                        <td>
                            @include('Main/site_extensions', [
                                'item' => $item,
                                'config' => $config,
                            ])
                        </td>
                        <td>
                            @include('Main/site_php', [
                                'item' => $item,
                                'config' => $config,
                                'php' => $config->get('core.php')
                            ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $this->pagination->getListFooter(['class' => 'form-select akeebaGridViewAutoSubmitOnChange']) }}
            <input type="hidden" name="task" value="">
        </form>
    </div>
</div>