<?php

namespace Filament\Forms\Concerns;

use Filament\Forms\ComponentContainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

trait InteractsWithForms
{
    use WithFileUploads;

    public array $componentFileAttachments = [];

    protected ?array $cachedForms = null;

    protected bool $isCachingForms = false;

    public function __get($property)
    {
        if (! $this->isCachingForms && $form = $this->getCachedForm($property)) {
            return $form;
        }

        return parent::__get($property);
    }

    public function dispatchFormEvent(...$args): void
    {
        foreach ($this->getCachedForms() as $form) {
            $form->dispatchEvent(...$args);
        }
    }

    public function getComponentFileAttachment(string $statePath): ?TemporaryUploadedFile
    {
        return data_get($this->componentFileAttachments, $statePath);
    }

    public function getComponentFileAttachmentUrl(string $statePath): ?string
    {
        foreach ($this->getCachedForms() as $form) {
            if ($url = $form->getComponentFileAttachmentUrl($statePath)) {
                return $url;
            }
        }

        return null;
    }

    public function getMultiSelectOptionLabels(string $statePath): array
    {
        foreach ($this->getCachedForms() as $form) {
            if ($labels = $form->getMultiSelectOptionLabels($statePath)) {
                return $labels;
            }
        }

        return [];
    }

    public function getMultiSelectSearchResults(string $statePath, string $query): array
    {
        foreach ($this->getCachedForms() as $form) {
            if ($results = $form->getMultiSelectSearchResults($statePath, $query)) {
                return $results;
            }
        }

        return [];
    }

    public function getSelectOptionLabel(string $statePath): ?string
    {
        foreach ($this->getCachedForms() as $form) {
            if ($label = $form->getSelectOptionLabel($statePath)) {
                return $label;
            }
        }

        return null;
    }

    public function getSelectSearchResults(string $statePath, string $query): array
    {
        foreach ($this->getCachedForms() as $form) {
            if ($results = $form->getSelectSearchResults($statePath, $query)) {
                return $results;
            }
        }

        return [];
    }

    public function deleteUploadedFile(string $statePath, string $fileKey): void
    {
        foreach ($this->getCachedForms() as $form) {
            $form->deleteUploadedFile($statePath, $fileKey);
        }
    }

    public function getUploadedFileUrl(string $statePath, string $fileKey): ?string
    {
        foreach ($this->getCachedForms() as $form) {
            if ($url = $form->getUploadedFileUrl($statePath, $fileKey)) {
                return $url;
            }
        }

        return null;
    }

    public function removeUploadedFile(string $statePath, string $fileKey): void
    {
        foreach ($this->getCachedForms() as $form) {
            $form->removeUploadedFile($statePath, $fileKey);
        }
    }

    public function reorderUploadedFiles(string $statePath, array $fileKeys): void
    {
        foreach ($this->getCachedForms() as $form) {
            $form->reorderUploadedFiles($statePath, $fileKeys);
        }
    }

    public function validate($rules = null, $messages = [], $attributes = [])
    {
        try {
            return parent::validate($rules, $messages, $attributes);
        } catch (ValidationException $exception) {
            $this->focusConcealedComponents(array_keys($exception->validator->failed()));

            throw $exception;
        }
    }

    public function validateOnly($field, $rules = null, $messages = [], $attributes = [])
    {
        try {
            return parent::validateOnly($field, $rules, $messages, $attributes);
        } catch (ValidationException $exception) {
            $this->focusConcealedComponents(array_keys($exception->validator->failed()));

            throw $exception;
        }
    }

    protected function callBeforeAndAfterSyncHooks($name, $value, $callback): void
    {
        parent::callBeforeAndAfterSyncHooks($name, $value, $callback);

        foreach ($this->getCachedForms() as $form) {
            $form->callAfterStateUpdated($name);
        }
    }

    protected function cacheForm(string $name): ComponentContainer
    {
        $this->isCachingForms = true;

        if ($this->cachedForms === null) {
            $this->cacheForms();
        } else {
            $this->cachedForms[$name] = $this->getForms()[$name];
        }

        $this->isCachingForms = false;

        return $this->cachedForms[$name];
    }

    protected function cacheForms(): array
    {
        $this->isCachingForms = true;

        $this->cachedForms = $this->getForms();

        $this->isCachingForms = false;

        return $this->cachedForms;
    }

    protected function focusConcealedComponents(array $statePaths): void
    {
        $componentToFocus = null;

        foreach ($this->getCachedForms() as $form) {
            if ($componentToFocus = $form->getInvalidComponentToFocus($statePaths)) {
                break;
            }
        }

        if ($concealingComponent = $componentToFocus?->getConcealingComponent()) {
            $this->dispatchBrowserEvent('expand-concealing-component', [
                'id' => $concealingComponent->getId(),
            ]);
        }
    }

    protected function getCachedForm($name): ?ComponentContainer
    {
        return $this->getCachedForms()[$name] ?? null;
    }

    protected function getCachedForms(): array
    {
        if ($this->cachedForms === null) {
            return $this->cacheForms();
        }

        return $this->cachedForms;
    }

    protected function getFormModel(): Model | string | null
    {
        return null;
    }

    protected function getFormSchema(): array
    {
        return [];
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema($this->getFormSchema())
                ->model($this->getFormModel())
                ->statePath($this->getFormStatePath()),
        ];
    }

    protected function getFormStatePath(): ?string
    {
        return null;
    }

    protected function getRules(): array
    {
        $rules = [];

        foreach ($this->getCachedForms() as $form) {
            $rules = array_merge($rules, $form->getValidationRules());
        }

        return $rules;
    }

    protected function getValidationAttributes(): array
    {
        $attributes = [];

        foreach ($this->getCachedForms() as $form) {
            $attributes = array_merge($attributes, $form->getValidationAttributes());
        }

        return $attributes;
    }

    protected function makeForm(): ComponentContainer
    {
        return ComponentContainer::make($this);
    }
}
