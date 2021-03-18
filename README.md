# ddd
Base concepts for a DDD approach


This library gives you some base building blocks in order to build a DDD architecture.


Introduce into your code some concepts like:
* Value Object
* Entity
* Collection


Value Objects could be `Simple` or `Composite`. 

Simple means that they contains only one primitive value (`string`, `int`, `bool`, `float`, `object`)

Composite, otherwise, that they have one or more value, that could be primitive, `SimpleValueObject`, another `CompositeValueObject`

Collections are "array" of Value Objects of the same type
