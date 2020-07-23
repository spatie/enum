## To v3

v3 is a major simplification of the package, and focuses only on the core enum functionality. The base enum implementation isn't changed, but there are changes to value/index and label/name mappings.

- The enum `index` is removed. Enum values can be remapped by implementing the `values` method. Please refer to the [README](./README.md) for more information.
- What used to be called `value` in v2 is now simply called `label`. Labels can be mapped like values, by implementing the `labels` method. Please refer to the [README](./README.md) for more information.
- The `isEqual` method has been renamed to `equals`, and now only accept `Enum` objects, no more raw strings or ints. 
- You can now also pass multiple enums to the `equals` method. Please refer to the [README](./README.md) for more information.
- Enum specific methods aren't supported anymore. If you want that kind of functionality, please look at [`spatie/laravel-model-states`](https://github.com/spatie/laravel-model-states), or the state pattern in general.
- Static equal methods are removed
