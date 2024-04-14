<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;

abstract class BaseDto
{
    /**
     * @return $this
     */
    public function buildFromRequest(Request $request): self
    {
        $properties = get_class_vars(get_class($this));
        foreach ($request->validated() as $key => $value) {
            if (array_key_exists($key, $properties)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function buildFromArray(array $data): self
    {
        $properties = get_class_vars(get_class($this));
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $properties)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        $data = [];
        $properties = get_class_vars($this::class);
        foreach ($properties as $property => $value) {
            $data[$property] = $this->$property;
        }

        return $data;
    }

    /**
     * @return $this
     */
    public function build(Request $request): self
    {
        $this->buildFromRequest($request);

        return $this;
    }

    public function buildWithoutNull(Request $request): self
    {
        $properties = get_class_vars(get_class($this));

        foreach ($request->validated() as $key => $value) {
            if (array_key_exists($key, $properties) && ! is_null($value)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    public function buildFromArrayWithoutNull(array $data): self
    {
        $properties = get_class_vars(get_class($this));

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $properties) && ! is_null($value)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    public function toArrayWithoutNull(): array
    {
        $data = [];
        $properties = get_class_vars(get_class($this));

        foreach ($properties as $property => $value) {
            if (isset($this->$property)) {
                $data[$property] = $this->$property;
            }
        }

        return $data;
    }
}
