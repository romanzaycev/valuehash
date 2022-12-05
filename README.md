ValueHash calculator
---

## Summary

The library is designed to calculate SHA-256 hash of the passed value.

The hash of only the values is calculated. Meta information about the class (such as the class name) will be ignored.
For the passed `stdClass` object and an instance of another class, the same hash will be calculated if the data in the public fields is the same.

## Supported types

- Scalars
- Arrays
- StdClass
- Objects
- and custom `Hashable` interface implementations

