<?php

namespace App\Http\Controllers;

use App\Exceptions\Label\LabelInUseException;
use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index(): View
    {
        $labels = Label::paginate(15);

        return view('labels.index', compact('labels'));
    }

    public function create(): View
    {
        return view('labels.create');
    }

    public function store(LabelRequest $request): RedirectResponse
    {
        $label = Label::create($request->validated());

        if ($label) {
            flash()->success(__('layout.flash.label.created'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $label = $label->fill($request->validated());

        if ($label->save()) {
            flash()->success(__('layout.flash.label.updated'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        try {
            $label->delete();
            flash()->success(__('layout.flash.label.deleted'));
        } catch (LabelInUseException $th) {
            flash()->error(__('layout.flash.label.delete_error'));
        } catch (\Exception $th) {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('labels.index');
    }
}
