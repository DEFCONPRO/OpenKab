    public function index(Request $request)
    {
        if ($request->ajax()){
            ${{ $config->modelNames->camelPlural }} = $this->{{ $config->modelNames->camel }}Repository->{!! $renderType !!};
            return $this->fractal($this->{{ $config->modelNames->camel }}Repository->list{{ $config->modelNames->name }}(), new {{ $config->modelNames->name }}Transformer, '{{ $config->modelNames->camelPlural }}')->respond();
        }

        return view('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.index');
    }
